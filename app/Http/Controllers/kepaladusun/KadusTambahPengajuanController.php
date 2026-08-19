<?php

namespace App\Http\Controllers\KepalaDusun;

use App\Http\Controllers\Controller;
use App\Models\master_penduduk;
use App\Models\master_surat;
use App\Models\master_pengajuan;
use App\Models\master_kartukeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KadusTambahPengajuanController extends Controller
{
    /**
     * Tampilkan form tambah pengajuan surat oleh Kepala Dusun.
     */
    public function index()
    {
        $datapenduduk = master_penduduk::orderBy('nama_lengkap')->get();
        $datasurat    = master_surat::orderBy('nama_surat')->get();

        return view('kepaladusun.tambah_pengajuan.index', compact('datapenduduk', 'datasurat'));
    }

    /**
     * Ambil daftar Kartu Keluarga untuk dropdown (AJAX).
     */
    public function getKKList()
    {
        $data = DB::table('master_kartukeluargas')
            ->select('no_kk', 'alamat', 'rt', 'rw')
            ->orderBy('no_kk')
            ->get();

        return response()->json(['status' => 'success', 'data' => $data]);
    }

    /**
     * Ambil daftar anggota keluarga berdasarkan No. KK (AJAX).
     */
    public function getAnggotaKK($no_kk)
    {
        $anggota = DB::table('master_penduduks')
            ->where('no_kk', $no_kk)
            ->select('nik', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'status_keluarga')
            ->get();

        return response()->json(['status' => 'success', 'no_kk' => $no_kk, 'data' => $anggota]);
    }

    /**
     * Ambil data penduduk berdasarkan NIK (AJAX).
     */
    public function getPendudukByNik(Request $request)
    {
        $nik = $request->nik;
        $penduduk = master_penduduk::where('nik', $nik)->first();

        if (!$penduduk) {
            return response()->json(['status' => 'error', 'message' => 'Penduduk tidak ditemukan.'], 404);
        }

        // Ambil info KK
        $kk = DB::table('master_kartukeluargas')->where('no_kk', $penduduk->no_kk)->first();

        return response()->json([
            'status'           => 'success',
            'nik'              => $penduduk->nik,
            'nama_lengkap'     => $penduduk->nama_lengkap,
            'no_kk'            => $penduduk->no_kk,
            'jenis_kelamin'    => $penduduk->jenis_kelamin,
            'tempat_lahir'     => $penduduk->tempat_lahir,
            'tanggal_lahir'    => $penduduk->tanggal_lahir,
            'status_keluarga'  => $penduduk->status_keluarga,
            'alamat'           => $kk ? $kk->alamat : '-',
            'rt'               => $kk ? $kk->rt : '-',
            'rw'               => $kk ? $kk->rw : '-',
        ]);
    }

    /**
     * Simpan pengajuan surat yang dibuat oleh Kepala Dusun atas nama Warga.
     * Status langsung: 'Disetujui Kepala Dusun' -> masuk ke antrian Admin Desa.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_registrasi' => 'required|string|max:100',
            'nik'           => 'required|string|size:16|exists:master_penduduks,nik',
            'id_surat'      => 'required|string|exists:master_surat,id_surat',
            'keperluan'     => 'required|string|max:500',
            'foto'          => 'nullable|array|max:9',
            'foto.*'        => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ], [
            'no_registrasi.required' => 'Nomor Registrasi Kepala Dusun wajib diisi.',
            'nik.required'           => 'Warga wajib dipilih.',
            'nik.exists'             => 'NIK warga tidak valid atau tidak terdaftar.',
            'id_surat.required'      => 'Jenis surat wajib dipilih.',
            'keperluan.required'     => 'Keperluan surat wajib diisi.',
        ]);

        $data = [
            'no_registrasi'    => $request->no_registrasi,
            'nik'              => $request->nik,
            'id_surat'         => $request->id_surat,
            'keperluan'        => $request->keperluan,
            'status'           => 'Disetujui Kepala Dusun', // Langsung disetujui Kadus
            'tanggal_diajukan' => Carbon::now()->toDateString(),
        ];

        // Upload foto (maks 9)
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $index => $file) {
                if ($index >= 9) break;
                $fotoKey        = 'foto' . ($index + 1);
                $path           = $file->store('pengajuan_kadus', 'public');
                $data[$fotoKey] = 'storage/' . $path;
            }
        }

        master_pengajuan::create($data);

        return redirect()->route('kadus.suratmasuk.index')
            ->with('success', 'Pengajuan surat berhasil dibuat dan langsung masuk ke antrian Admin Desa.');
    }
}
