<?php

namespace App\Http\Controllers\KepalaDesa;

use App\Http\Controllers\Controller;
use App\Models\View_data_pengajuan;
use App\Models\master_pengajuan;
use App\Http\Controllers\Admin\GeneratePDFController;
use Illuminate\Http\Request;

class KadesSuratMasukController extends Controller
{
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;

        $query = View_data_pengajuan::where(function ($q) {
            $q->where('status', 'Disetujui Sekdes')
              ->orWhere('status', 'Disetujui RW')
              ->orWhere('status', 'Diajukan');
        });

        if (!empty($katakunci)) {
            $query->where(function ($q) use ($katakunci) {
                $q->where('nik', 'like', "%$katakunci%")
                  ->orWhere('nama_lengkap', 'like', "%$katakunci%")
                  ->orWhere('nama_surat', 'like', "%$katakunci%");
            });
        }

        $datapengajuan = $query->orderBy('id_pengajuan', 'desc')->paginate(10)->appends($request->query());

        return view('kepaladesa.suratmasuk.index', compact('datapengajuan'));
    }

    public function setuju($id_pengajuan)
    {
        $pengajuan = master_pengajuan::findOrFail($id_pengajuan);
        $pengajuan->status = 'Selesai';
        $pengajuan->save();

        try {
            $generate = new GeneratePDFController();
            $generate->generateAndStorePdf($id_pengajuan);
        } catch (\Exception $e) {
            // PDF generator optional if template available
        }

        return redirect()->back()->with('success', 'Surat berhasil disahkan (TTE Kepala Desa).');
    }

    public function tolak(Request $request, $id_pengajuan)
    {
        $request->validate([
            'keterangan_ditolak' => 'required|string|max:255',
        ]);

        $pengajuan = master_pengajuan::findOrFail($id_pengajuan);
        $pengajuan->status = 'Ditolak Kades';
        $pengajuan->keterangan_ditolak = $request->keterangan_ditolak;
        $pengajuan->save();

        return redirect()->back()->with('success', 'Pengajuan surat ditolak.');
    }
}
