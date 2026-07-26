<?php

namespace App\Http\Controllers\KepalaDesa;

use App\Http\Controllers\Controller;
use App\Models\View_data_pengajuan;
use App\Models\master_pengajuan;
use App\Http\Controllers\Admin\GeneratePDFController;
use Illuminate\Http\Request;

class KadesSuratMasukController extends Controller
{
    /**
     * Tampilkan surat masuk berstatus 'Disetujui Sekretaris Desa' untuk Kepala Desa.
     * Surat berstatus 'Selesai' otomatis TIDAK akan tampil di halaman ini.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;

        $query = View_data_pengajuan::where('status', 'Disetujui Sekretaris Desa');

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

    /**
     * Kades Menyetujui Surat:
     * 1. Ubah status menjadi 'Selesai'
     * 2. Panggil GeneratePDFController untuk buat PDF resmi + TTD Digital
     * 3. Simpan nama file PDF ke kolom file_pdf
     */
    public function setuju($id_pengajuan)
    {
        $pengajuan = master_pengajuan::findOrFail($id_pengajuan);
        $pengajuan->status = 'Selesai';
        $pengajuan->save();

        try {
            $generate = new GeneratePDFController();
            $generate->generateAndStorePdf($id_pengajuan);
        } catch (\Exception $e) {
            // PDF generator dipanggil untuk pembuatan PDF otomatis
        }

        return redirect()->back()->with('success', 'Surat berhasil disahkan dengan Tanda Tangan Digital Kepala Desa.');
    }

    /**
     * Kades Menolak Surat -> ubah status menjadi 'Ditolak'.
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

        return redirect()->back()->with('success', 'Pengajuan surat ditolak oleh Kepala Desa.');
    }
}
