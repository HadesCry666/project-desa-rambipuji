<?php

namespace App\Http\Controllers\KepalaDesa;

use App\Http\Controllers\Controller;
use App\Models\View_data_pengajuan;
use App\Models\master_pengajuan;
use App\Http\Controllers\Admin\GeneratePDFController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Log;

class KadesSuratMasukController extends Controller
{
    /**
     * Tampilkan surat masuk berstatus 'Disetujui Sekretaris Desa' untuk Kepala Desa.
     * Surat berstatus 'Selesai' otomatis TIDAK akan tampil di halaman ini.
     */
    public function index(Request $request)
{
    $katakunci = $request->katakunci;

    $query = View_data_pengajuan::where(
        'status',
        'Disetujui Sekretaris Desa'
    );

    if (!empty($katakunci)) {
        $query->where(function ($q) use ($katakunci) {
            $q->where('nik', 'like', "%{$katakunci}%")
              ->orWhere('nama_lengkap', 'like', "%{$katakunci}%")
              ->orWhere('nama_surat', 'like', "%{$katakunci}%");
        });
    }

    $datapengajuan = $query
        ->orderBy('id_pengajuan', 'desc')
        ->paginate(10)
        ->appends($request->query());


    // ==========================================
    // GENERATE NOMOR SURAT BERIKUTNYA
    // ==========================================

    $tahun = now()->year;

    $kodeAwal = '511';

    $kodeDesa = '35.09.13.2006';


    // Ambil nomor terbesar tahun berjalan
    $terakhir = DB::table('master_pengajuan')
        ->whereNotNull('nomor_surat_keluar')
        ->where(
            'nomor_surat_keluar',
            'like',
            "{$kodeAwal}/%/{$kodeDesa}/{$tahun}"
        )
        ->max(DB::raw("
            CAST(
                SUBSTRING_INDEX(
                    SUBSTRING_INDEX(
                        nomor_surat_keluar,
                        '/',
                        2
                    ),
                    '/',
                    -1
                ) AS UNSIGNED
            )
        "));


    // Nomor berikutnya
    $nomorUrut = ((int) ($terakhir ?? 0)) + 1;


    // 3 digit
    $nomorUrut = str_pad(
        $nomorUrut,
        3,
        '0',
        STR_PAD_LEFT
    );


    // Nomor surat
    $noRegistrasi =
        "{$kodeAwal}/{$nomorUrut}/{$kodeDesa}/{$tahun}";


    return view(
        'kepaladesa.suratmasuk.index',
        compact(
            'datapengajuan',
            'noRegistrasi'
        )
    );
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
    $tahun = now()->year;

    $kodeAwal = '511';
    $kodeDesa = '35.09.13.2006';

    // Cari nomor urut terbesar pada tahun berjalan
    $terakhir = DB::table('master_pengajuan')
        ->whereNotNull('nomor_surat_keluar')
        ->where(
            'nomor_surat_keluar',
            'like',
            "{$kodeAwal}/%/{$kodeDesa}/{$tahun}"
        )
        ->max(DB::raw("
            CAST(
                SUBSTRING_INDEX(
                    SUBSTRING_INDEX(
                        nomor_surat_keluar,
                        '/',
                        2
                    ),
                    '/',
                    -1
                ) AS UNSIGNED
            )
        "));

    // Nomor berikutnya
    $nomorUrut = ((int) ($terakhir ?? 0)) + 1;

    // 3 digit
    $nomorUrut = str_pad(
        $nomorUrut,
        3,
        '0',
        STR_PAD_LEFT
    );

    // Nomor surat lengkap
    return "{$kodeAwal}/{$nomorUrut}/{$kodeDesa}/{$tahun}";
}

   public function setuju($id_pengajuan)
{
    $pengajuan = master_pengajuan::findOrFail($id_pengajuan);

    // Generate nomor surat keluar jika belum ada
    if (empty($pengajuan->nomor_surat_keluar)) {

        $pengajuan->nomor_surat_keluar =
            self::generateNomorSuratKeluar();
    }

    // Ubah status
    $pengajuan->status = 'Selesai';

    // Simpan
    $pengajuan->save();

    // Generate PDF
    try {

        $generate = new GeneratePDFController();

        $generate->generateAndStorePdf(
            $id_pengajuan
        );

    } catch (\Exception $e) {

        Log::error(
            'Gagal generate PDF',
            [
                'id_pengajuan' => $id_pengajuan,
                'error' => $e->getMessage(),
            ]
        );
    }

    return redirect()
        ->back()
        ->with(
            'success',
            'Surat berhasil disahkan dengan Tanda Tangan Digital Kepala Desa.'
        );
}

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
