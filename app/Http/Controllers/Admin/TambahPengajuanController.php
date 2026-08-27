<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\master_penduduk;
use App\Models\master_surat;
use App\Models\master_kartukeluarga;
use App\Models\master_dusun;
use App\Models\master_pengajuan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TambahPengajuanController extends Controller
{
    public function index()
{
    $datapenduduk = master_penduduk::orderBy('nama_lengkap')->get();
    $datasurat = master_surat::orderBy('nama_surat')->get();

    // Tanggal sekarang
    $tanggal = Carbon::now();

    $bulan = $tanggal->month;
    $tahun = $tanggal->year;

    // Konversi bulan ke Romawi
    $bulanRomawi = [
        1  => 'I',
        2  => 'II',
        3  => 'III',
        4  => 'IV',
        5  => 'V',
        6  => 'VI',
        7  => 'VII',
        8  => 'VIII',
        9  => 'IX',
        10 => 'X',
        11 => 'XI',
        12 => 'XII',
    ];

    $bulanSekarang = $bulanRomawi[$bulan];

    /*
    |--------------------------------------------------------------------------
    | Cari nomor urut TERBESAR pada bulan & tahun yang sama
    |--------------------------------------------------------------------------
    */

    $nomorUrutTerakhir = master_pengajuan::whereYear('created_at', $tahun)
        ->whereMonth('created_at', $bulan)
        ->whereNotNull('no_registrasi')
        ->selectRaw("
            MAX(
                CAST(
                    SUBSTRING_INDEX(
                        SUBSTRING_INDEX(no_registrasi, '/', 2),
                        '/',
                        -1
                    ) AS UNSIGNED
                )
            ) as nomor
        ")
        ->value('nomor') ?? 0;

    // Nomor urut berikutnya
    $nomorUrut = str_pad(
        $nomorUrutTerakhir + 1,
        3,
        '0',
        STR_PAD_LEFT
    );

    /*
    |--------------------------------------------------------------------------
    | Nomor registrasi sementara
    |--------------------------------------------------------------------------
    */

    $noRegistrasi =
        "407/{$nomorUrut}/2006.--/{$bulanSekarang}/{$tahun}";

    return view(
        'admin.pengajuan_surat.tambah_pengajuan',
        compact(
            'datapenduduk',
            'datasurat',
            'noRegistrasi'
        )
    );
}

    public function store(Request $request)
    {
        $request->validate([
            'no_registrasi' => 'required|string|max:100',
            'nik'           => 'required|string|exists:master_penduduks,nik',
            'id_surat'      => 'required|string|exists:master_surat,id_surat',
            'keperluan'     => 'nullable|string|max:500',
            'foto'          => 'nullable|array|max:8',
            'foto.*'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'no_registrasi.required' => 'Nomor Registrasi Kepala Dusun wajib diisi.',
            'nik.required'           => 'NIK / Nama Penduduk wajib dipilih.',
            'id_surat.required'      => 'Jenis Surat wajib dipilih.',
        ]);

        $data = [
            'no_registrasi'    => $request->no_registrasi,
            'nik'              => $request->nik,
            'id_surat'         => $request->id_surat,
            'keterangan_admin' => $request->keperluan,
            'keperluan' => $request->keperluan,
            'status'           => 'Disetujui Admin',
            'tanggal_diajukan' => Carbon::now()->toDateString(),
        ];

        // Upload foto jika ada (maks 8)
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $index => $file) {
                if ($index >= 8) break;
                $fotoKey        = 'foto' . ($index + 1);
                $path           = $file->store('pengajuan', 'public');
                $data[$fotoKey] = 'storage/' . $path;
            }
        }

        master_pengajuan::create($data);

        return redirect()->route('pengajuan.tambah.index')
            ->with('success', 'Pengajuan surat berhasil ditambahkan dengan Nomor Registrasi Kepala Dusun.');
    }

    public function getDusunByNik($nik)
{
    $penduduk = master_penduduk::where('nik', $nik)->first();

    if (!$penduduk) {
        return response()->json([
            'success' => false,
            'message' => 'Data penduduk tidak ditemukan.'
        ], 404);
    }

    $kk = master_kartukeluarga::where(
        'no_kk',
        $penduduk->no_kk
    )->first();

    if (!$kk) {
        return response()->json([
            'success' => false,
            'message' => 'Data KK tidak ditemukan.'
        ], 404);
    }

    $dusun = master_dusun::where(
        'nama_dusun',
        trim($kk->dusun)
    )->first();

    if (!$dusun) {
        return response()->json([
            'success' => false,
            'message' => 'Dusun "' . $kk->dusun . '" tidak ditemukan di master dusun.'
        ], 404);
    }

    $nomorDusun = str_pad(
        $dusun->id_dusun,
        2,
        '0',
        STR_PAD_LEFT
    );

    return response()->json([
        'success' => true,
        'nik' => $penduduk->nik,
        'no_kk' => $penduduk->no_kk,
        'nama_dusun' => $dusun->nama_dusun,
        'id_dusun' => $dusun->id_dusun,
        'nomor_dusun' => $nomorDusun,
    ]);
}
}
