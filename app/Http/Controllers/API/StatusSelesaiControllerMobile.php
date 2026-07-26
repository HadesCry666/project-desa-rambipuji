<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusSelesaiControllerMobile extends Controller
{
    /**
     * Tampilkan daftar pengajuan yang sudah selesai milik user yang sedang login.
     * NIK diambil dari token Sanctum — tidak bisa di-spoof.
     * 
     * Fix: status 'Selesai' (kapital) sesuai dengan nilai yang disimpan di database.
     */
    public function index(Request $request)
    {
        $nik = $request->user()->nik;

        $data = DB::table('master_pengajuan')
            ->join('master_surat', 'master_pengajuan.id_surat', '=', 'master_surat.id_surat')
            ->select(
                'master_pengajuan.id_pengajuan',
                'master_surat.nama_surat',
                'master_pengajuan.keperluan',
                'master_pengajuan.updated_at',
                'master_pengajuan.status',
                'master_pengajuan.file_pdf',
            )
            ->where('master_pengajuan.nik', $nik)
            ->where('master_pengajuan.status', 'Selesai') // Fix: huruf kapital sesuai database
            ->orderBy('master_pengajuan.updated_at', 'desc')
            ->get();

        // Ubah path file PDF menjadi URL yang bisa diakses
        $data->transform(function ($item) {
            if ($item->file_pdf && $item->file_pdf !== '-') {
                // Ambil hanya nama file (bersihkan path jika ada)
                $filename = basename($item->file_pdf);
                $item->file_pdf_url = asset('storage/generatesurat/' . $filename);
            } else {
                $item->file_pdf_url = null;
            }
            // Sembunyikan raw path dari response
            unset($item->file_pdf);
            return $item;
        });

        return response()->json([
            'status' => 'success',
            'total'  => $data->count(),
            'data'   => $data,
        ]);
    }
}
