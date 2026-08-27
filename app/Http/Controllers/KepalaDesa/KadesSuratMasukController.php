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
        $nomorSuratKeluarDefault = self::generateNomorSuratKeluar();

        return view('kepaladesa.suratmasuk.index', compact('datapengajuan', 'nomorSuratKeluarDefault'));
    }

    /**
     * Generate Nomor Surat Keluar Resmi.
     * Format: 511/{nomor_urut}/35.09.13.2006/{tahun}
     * Contoh: 511/135/35.09.13.2006/2026
     * - 511          : kode tetap
     * - nomor_urut   : auto-increment per tahun (reset setiap tahun baru)
     * - 35.09.13.2006: kode desa tetap
     * - tahun        : tahun saat ini
     */
    public static function generateNomorSuratKeluar(): string
    {
        $tahun    = date('Y');
        $kodeAwal = '511';
        $kodeDesa = '35.09.13.2006';

        // Ambil nomor urut terbesar tahun ini
        // Format surat: "511/{urut}/35.09.13.2006/{tahun}" -> bagian ke-2 adalah nomor urut
        $terakhir = \Illuminate\Support\Facades\DB::table('master_pengajuan')
            ->whereNotNull('nomor_surat_keluar')
            ->where('nomor_surat_keluar', 'like', "{$kodeAwal}/%/{$kodeDesa}/{$tahun}")
            ->max(\Illuminate\Support\Facades\DB::raw(
                "CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(nomor_surat_keluar, '/', 2), '/', -1) AS UNSIGNED)"
            ));

        // Jika belum ada surat tahun ini, mulai dari 1; jika ada, tambah 1
        $nomorUrut = $terakhir ? ((int) $terakhir + 1) : 1;

        return "{$kodeAwal}/{$nomorUrut}/{$kodeDesa}/{$tahun}";
    }

    /**
     * Kades Menyetujui Surat:
     * 1. Simpan nomor surat keluar (dari form input atau auto-generate)
     * 2. Ubah status menjadi 'Selesai'
     * 3. Panggil GeneratePDFController untuk buat PDF resmi + TTD Digital
     * 4. Simpan nama file PDF ke kolom file_pdf
     */
    public function setuju(Request $request, $id_pengajuan)
    {
        $pengajuan = master_pengajuan::findOrFail($id_pengajuan);

        // Ambil nomor_surat_keluar dari input form jika diisi, jika kosong baru auto-generate
        if ($request->filled('nomor_surat_keluar')) {
            $pengajuan->nomor_surat_keluar = $request->nomor_surat_keluar;
        } elseif (empty($pengajuan->nomor_surat_keluar)) {
            $pengajuan->nomor_surat_keluar = self::generateNomorSuratKeluar();
        }

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
