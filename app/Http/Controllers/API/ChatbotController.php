<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatbotController extends Controller
{
    public function index()
    {
        $surat = DB::table('master_surat')
            ->select(
                'id_surat',
                'nama_surat',
                'slug',
                'keterangan',
                'berkas1',
                'berkas2',
                'berkas3',
                'berkas4',
                'berkas5',
                'berkas6',
                'berkas7',
                'berkas8',
                'berkas9'
            )
            ->get()
            ->map(function ($item) {
                return [
                    'id_surat' => $item->id_surat,
                    'nama_surat' => $item->nama_surat,
                    'slug' => $item->slug,
                    'keterangan' => $item->keterangan,
                    'keywords' => $this->generateKeywords($item->nama_surat, $item->slug),
                    'syarat' => $this->getBerkas($item),
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'Data surat chatbot berhasil diambil',
            'data' => $surat,
        ], 200);
    }

    public function cekPertanyaan(Request $request)
    {
        $request->validate([
            'pesan' => 'required|string',
        ]);

        $pesan = strtolower(trim($request->pesan));

        if ($this->isPertanyaanDaftarSurat($pesan)) {
            return response()->json([
                'success' => true,
                'source' => 'database',
                'jawaban' => $this->getDaftarSurat(),
            ]);
        }

        if ($this->isPertanyaanCaraPengajuan($pesan)) {
            return response()->json([
                'success' => true,
                'source' => 'local',
                'jawaban' => $this->getCaraPengajuan(),
            ]);
        }

        $surat = DB::table('master_surat')
            ->select(
                'id_surat',
                'nama_surat',
                'slug',
                'keterangan',
                'berkas1',
                'berkas2',
                'berkas3',
                'berkas4',
                'berkas5',
                'berkas6',
                'berkas7',
                'berkas8',
                'berkas9'
            )
            ->get();

        foreach ($surat as $item) {
            $keywords = $this->generateKeywords($item->nama_surat, $item->slug);

            foreach ($keywords as $keyword) {
                if (str_contains($pesan, strtolower($keyword))) {
                    return response()->json([
                        'success' => true,
                        'source' => 'database',
                        'jawaban' => $this->getDetailSurat($item),
                    ]);
                }
            }
        }

        return response()->json([
            'success' => false,
            'source' => 'database',
            'jawaban' => null,
            'message' => 'Pertanyaan tidak ditemukan di data surat',
        ]);
    }

    private function getBerkas($item)
    {
        $berkas = [];

        for ($i = 1; $i <= 9; $i++) {
            $field = 'berkas' . $i;

            if (!empty($item->$field) && $item->$field !== '-') {
                $berkas[] = $item->$field;
            }
        }

        return $berkas;
    }

    private function generateKeywords($namaSurat, $slug)
    {
        $nama = strtolower($namaSurat);
        $slugText = strtolower(str_replace('-', ' ', $slug));

        $keywords = [
            $nama,
            $slugText,
        ];

        if (str_contains($nama, 'ktp')) {
            $keywords = array_merge($keywords, [
                'ktp',
                'kartu tanda penduduk',
                'buat ktp',
                'bikin ktp',
                'syarat ktp',
            ]);
        }

        if (str_contains($nama, 'kartu keluarga')) {
            $keywords = array_merge($keywords, [
                'kk',
                'kartu keluarga',
                'buat kk',
                'bikin kk',
                'syarat kk',
            ]);
        }

        if (str_contains($nama, 'kelahiran')) {
            $keywords = array_merge($keywords, [
                'akte kelahiran',
                'akta kelahiran',
                'surat kelahiran',
                'buat akte',
                'buat akta',
                'kelahiran',
            ]);
        }

        if (str_contains($nama, 'sktm') || str_contains($nama, 'tidak mampu')) {
            $keywords = array_merge($keywords, [
                'sktm',
                'surat keterangan tidak mampu',
                'tidak mampu',
                'surat miskin',
            ]);
        }

        if (str_contains($nama, 'perkawinan')) {
            $keywords = array_merge($keywords, [
                'akta perkawinan',
                'akte perkawinan',
                'surat perkawinan',
                'perkawinan',
                'pernikahan',
                'nikah',
            ]);
        }

        if (str_contains($nama, 'kematian')) {
            $keywords = array_merge($keywords, [
                'akta kematian',
                'akte kematian',
                'surat kematian',
                'kematian',
                'meninggal',
            ]);
        }

        if (str_contains($nama, 'pindah')) {
            $keywords = array_merge($keywords, [
                'pindah penduduk',
                'surat pindah',
                'surat keterangan pindah',
                'pindah domisili',
                'pindah alamat',
                'pindah',
            ]);
        }

        if (str_contains($nama, 'pernyataan miskin')) {
            $keywords = array_merge($keywords, [
                'pernyataan miskin',
                'surat pernyataan miskin',
                'miskin',
                'keterangan miskin',
            ]);
        }

        return array_values(array_unique($keywords));
    }

    private function isPertanyaanDaftarSurat($pesan)
    {
        return str_contains($pesan, 'jenis surat') ||
            str_contains($pesan, 'daftar surat') ||
            str_contains($pesan, 'surat apa saja') ||
            str_contains($pesan, 'apa saja surat') ||
            str_contains($pesan, 'layanan surat') ||
            str_contains($pesan, 'macam macam surat') ||
            str_contains($pesan, 'surat yang tersedia');
    }

    private function isPertanyaanCaraPengajuan($pesan)
    {
        return str_contains($pesan, 'cara mengajukan') ||
            str_contains($pesan, 'cara pengajuan') ||
            str_contains($pesan, 'ajukan surat') ||
            str_contains($pesan, 'pengajuan surat') ||
            str_contains($pesan, 'buat surat');
    }

    private function getDaftarSurat()
    {
        $surat = DB::table('master_surat')
            ->select('nama_surat')
            ->orderBy('nama_surat', 'asc')
            ->get();

        if ($surat->isEmpty()) {
            return 'Data surat belum tersedia.';
        }

        $jawaban = "Jenis surat yang tersedia di aplikasi Digital Village:\n\n";

        foreach ($surat as $index => $item) {
            $jawaban .= ($index + 1) . ". " . $item->nama_surat . "\n";
        }

        $jawaban .= "\nUntuk mengajukan surat, masuk ke menu Pengajuan Surat lalu pilih jenis surat yang dibutuhkan.";

        return $jawaban;
    }

    private function getCaraPengajuan()
    {
        return "Cara mengajukan surat secara online:\n"
            . "1. Login ke aplikasi Digital Village\n"
            . "2. Masuk ke menu Pengajuan Surat\n"
            . "3. Pilih jenis surat yang ingin diajukan\n"
            . "4. Isi formulir pengajuan dengan benar\n"
            . "5. Upload berkas persyaratan yang diminta\n"
            . "6. Klik tombol Kirim Pengajuan\n"
            . "7. Tunggu proses verifikasi dari RT, RW, atau Admin Desa\n"
            . "8. Cek status pengajuan melalui menu Riwayat Pengajuan\n\n"
            . "Dengan fitur ini, masyarakat dapat mengajukan surat tanpa harus datang langsung ke kantor desa.";
    }

    private function getDetailSurat($item)
    {
        $berkas = $this->getBerkas($item);

        $jawaban = "Syarat " . $item->nama_surat . ":\n";

        if (empty($berkas)) {
            $jawaban .= "Persyaratan belum tersedia di database.\n";
        } else {
            foreach ($berkas as $index => $value) {
                $jawaban .= ($index + 1) . ". " . $value . "\n";
            }
        }

        $jawaban .= "\nCara pengajuan:\n";
        $jawaban .= "1. Login ke aplikasi Digital Village\n";
        $jawaban .= "2. Masuk ke menu Pengajuan Surat\n";
        $jawaban .= "3. Pilih " . $item->nama_surat . "\n";
        $jawaban .= "4. Isi formulir pengajuan\n";
        $jawaban .= "5. Upload berkas persyaratan\n";
        $jawaban .= "6. Klik tombol Kirim Pengajuan\n";
        $jawaban .= "7. Tunggu proses verifikasi dari RT, RW, atau Admin Desa\n";

        return $jawaban;
    }
}