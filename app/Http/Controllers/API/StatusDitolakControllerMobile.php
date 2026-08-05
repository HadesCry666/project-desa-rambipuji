<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StatusDitolakControllerMobile extends Controller
{
    /**
     * Tampilkan daftar pengajuan yang ditolak milik user yang sedang login.
     * NIK diambil dari token Sanctum — tidak bisa di-spoof.
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
                'master_pengajuan.status',
                'master_pengajuan.keterangan_ditolak',
                'master_pengajuan.updated_at',
            )
            ->where('master_pengajuan.nik', $nik)
            ->whereIn('master_pengajuan.status', [
                'Ditolak Sekdes',
                'Ditolak RW',
                'Ditolak',
            ])
            ->orderBy('master_pengajuan.updated_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'total'  => $data->count(),
            'data'   => $data,
        ]);
    }
}
