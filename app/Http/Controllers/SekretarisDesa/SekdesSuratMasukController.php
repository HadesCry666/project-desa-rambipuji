<?php

namespace App\Http\Controllers\SekretarisDesa;

use App\Http\Controllers\Controller;
use App\Models\View_data_pengajuan;
use App\Models\master_pengajuan;
use Illuminate\Http\Request;

class SekdesSuratMasukController extends Controller
{
    /**
     * Tampilkan surat masuk berstatus 'Disetujui Admin' untuk Sekretaris Desa.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;

        $query = View_data_pengajuan::where('status', 'Disetujui Admin');

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

    /**
     * Sekdes Menyetujui Surat -> ubah status menjadi 'Disetujui Sekretaris Desa'.
     */
    public function setuju($id_pengajuan)
    {
        $pengajuan = master_pengajuan::findOrFail($id_pengajuan);
        $pengajuan->status = 'Disetujui Sekretaris Desa';
        $pengajuan->save();

        return redirect()->back()->with('success', 'Pengajuan berhasil disetujui oleh Sekretaris Desa dan diteruskan ke Kepala Desa.');
    }

    /**
     * Sekdes Menolak Surat -> ubah status menjadi 'Ditolak'.
     */
    public function tolak(Request $request, $id_pengajuan)
    {
        $request->validate([
            'keterangan_ditolak' => 'required|string|max:255',
        ], [
            'keterangan_ditolak.required' => 'Alasan penolakan wajib diisi.',
        ]);

        $pengajuan = master_pengajuan::findOrFail($id_pengajuan);
        $pengajuan->status = 'Ditolak';
        $pengajuan->keterangan_ditolak = $request->keterangan_ditolak;
        $pengajuan->save();

        return redirect()->back()->with('success', 'Pengajuan telah ditolak.');
    }
}
