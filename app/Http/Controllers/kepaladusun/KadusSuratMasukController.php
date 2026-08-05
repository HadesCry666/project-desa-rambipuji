<?php

namespace App\Http\Controllers\KepalaDusun;

use App\Http\Controllers\Controller;
use App\Models\View_data_pengajuan;
use App\Models\master_pengajuan;
use Illuminate\Http\Request;

class KadusSuratMasukController extends Controller
{
    /**
     * Tampilkan surat masuk berstatus 'Diajukan' untuk Kepala Dusun.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;

        $query = View_data_pengajuan::where('status', 'Diajukan');

        if (!empty($katakunci)) {
            $query->where(function ($q) use ($katakunci) {
                $q->where('nik', 'like', "%$katakunci%")
                  ->orWhere('nama_lengkap', 'like', "%$katakunci%")
                  ->orWhere('nama_surat', 'like', "%$katakunci%");
            });
        }

        $datapengajuan = $query->orderBy('id_pengajuan', 'desc')->paginate(10)->appends($request->query());

        return view('kepaladusun.suratmasuk.index', compact('datapengajuan'));
    }

    /**
     * Setujui pengajuan surat (Kadus) -> ubah status menjadi 'Disetujui Kepala Dusun'.
     */
    public function setuju($id_pengajuan)
    {
        $pengajuan = master_pengajuan::findOrFail($id_pengajuan);
        $pengajuan->status = 'Disetujui Kepala Dusun';
        $pengajuan->save();

        return redirect()->back()->with('success', 'Pengajuan berhasil disetujui oleh Kepala Dusun dan diteruskan ke Admin.');
    }

    /**
     * Tolak pengajuan surat (Kadus) -> ubah status menjadi 'Ditolak'.
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

    /**
     * Tampilkan surat selesai untuk Kepala Dusun.
     */
    public function suratselesai(Request $request)
    {
        $katakunci = $request->katakunci;

        $query = View_data_pengajuan::where('status', 'Disetujui Kepala Dusun');

        if (!empty($katakunci)) {
            $query->where(function ($q) use ($katakunci) {
                $q->where('nik', 'like', "%$katakunci%")
                  ->orWhere('nama_lengkap', 'like', "%$katakunci%")
                  ->orWhere('nama_surat', 'like', "%$katakunci%");
            });
        }

        $datapengajuan = $query->orderBy('id_pengajuan', 'desc')->paginate(10)->appends($request->query());

        return view('kepaladusun.suratselesai.index', compact('datapengajuan'));
    }

    /**
     * Tampilkan surat ditolak untuk Kepala Dusun.
     */
    public function suratditolak(Request $request)
    {
        $katakunci = $request->katakunci;

        $query = View_data_pengajuan::where('status', 'Ditolak');

        if (!empty($katakunci)) {
            $query->where(function ($q) use ($katakunci) {
                $q->where('nik', 'like', "%$katakunci%")
                  ->orWhere('nama_lengkap', 'like', "%$katakunci%")
                  ->orWhere('nama_surat', 'like', "%$katakunci%");
            });
        }

        $datapengajuan = $query->orderBy('id_pengajuan', 'desc')->paginate(10)->appends($request->query());

        return view('kepaladusun.suratditolak.index', compact('datapengajuan'));
    }
}
