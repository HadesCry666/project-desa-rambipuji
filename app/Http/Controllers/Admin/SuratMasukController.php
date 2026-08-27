<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\View_data_pengajuan;
use App\Models\master_pengajuan;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    /**
     * Tampilkan surat masuk untuk Admin.
     * Status yang ditampilkan: 'Disetujui Kepala Dusun' dan 'Diajukan'.
     */
    public function index(Request $request)
    {
        $jumlahbaris = 10;
        $katakunci = $request->katakunci;

        $query = View_data_pengajuan::where(function ($q) {
            $q->where('status', 'Disetujui Kepala Dusun')
              ->orWhere('status', 'Disetujui Kepala Dusun');
        });

        if (strlen($katakunci)) {
            $query->where(function ($q) use ($katakunci) {
                $q->where('nik', 'like', "%$katakunci%")
                  ->orWhere('nama_lengkap', 'like', "%$katakunci%")
                  ->orWhere('nama_surat', 'like', "%$katakunci%");
            });
        }

        $datapengajuan = $query->orderBy('id_pengajuan', 'desc')->paginate($jumlahbaris);

        return view('admin.pengajuan_surat.suratmasuk', compact('datapengajuan'));
    }

    /**
     * Admin Menyetujui Surat.
     * WAJIB mengisi keterangan_admin terlebih dahulu!
     * Status berubah menjadi 'Disetujui Admin'.
     */
    public function setuju(Request $request, $id_pengajuan)
    {
        $request->validate([
            'keterangan_admin' => 'required|string|max:500',
        ], [
            'keterangan_admin.required' => 'Keterangan hasil verifikasi admin wajib diisi.',
            'keterangan_admin.max'      => 'Keterangan admin maksimal 500 karakter.',
        ]);

        $pengajuan = master_pengajuan::findOrFail($id_pengajuan);
        $pengajuan->status = 'Disetujui Admin';
        $pengajuan->keterangan_admin = $request->keterangan_admin;
        $pengajuan->save();

        return redirect()->back()->with('success', 'Pengajuan berhasil disetujui oleh Admin dan diteruskan ke Sekretaris Desa.');
    }

    /**
     * Admin Menolak Surat.
     * Status berubah menjadi 'Ditolak'.
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

        return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui menjadi Ditolak.');
    }

    /**
     * Hapus pengajuan.
     */
    public function destroy($id_pengajuan)
    {
        $pengajuan = master_pengajuan::findOrFail($id_pengajuan);
        $pengajuan->delete();

        return redirect()->back()->with('success', 'Pengajuan berhasil dihapus.');
    }
}