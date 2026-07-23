<?php

namespace App\Http\Controllers\SekretarisDesa;

use App\Http\Controllers\Controller;
use App\Models\View_data_pengajuan;
use App\Models\master_pengajuan;
use Illuminate\Http\Request;

class SekdesSuratMasukController extends Controller
{
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;

        $query = View_data_pengajuan::where(function ($q) {
            $q->where('status', 'Disetujui RW')
              ->orWhere('status', 'Disetujui Admin')
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

        return view('sekretarisdesa.suratmasuk.index', compact('datapengajuan'));
    }

    public function setuju($id_pengajuan)
    {
        $pengajuan = master_pengajuan::findOrFail($id_pengajuan);
        $pengajuan->status = 'Disetujui Sekdes';
        $pengajuan->save();

        return redirect()->back()->with('success', 'Pengajuan berhasil disetujui oleh Sekretaris Desa.');
    }

    public function tolak(Request $request, $id_pengajuan)
    {
        $request->validate([
            'keterangan_ditolak' => 'required|string|max:255',
        ]);

        $pengajuan = master_pengajuan::findOrFail($id_pengajuan);
        $pengajuan->status = 'Ditolak Sekdes';
        $pengajuan->keterangan_ditolak = $request->keterangan_ditolak;
        $pengajuan->save();

        return redirect()->back()->with('success', 'Pengajuan telah ditolak.');
    }
}
