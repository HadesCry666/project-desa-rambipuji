<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardRTController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $nik = $user->nik ?? $user->username;

        // Ambil RT RW user login
        $rtData = DB::table('master_rt_rw')
            ->where('nik', $nik)
            ->first();

        // Jika data RT tidak ditemukan
        if (!$rtData) {
            return view('rt.dashboard', [
                'error' => 'Data RT tidak ditemukan',
                'rt' => '-',
                'rw' => '-',
                'jumlahPenduduk' => 0,
                'jumlahKK' => 0,
                'jumlahLaki' => 0,
                'jumlahWanita' => 0,
                'jumlahSuratMasuk' => 0,
                'jumlahSuratDitolak' => 0,
                'jumlahSuratSelesai' => 0,
            ]);
        }

        $rt = $rtData->rt;
        $rw = $rtData->rw;

        // Ambil semua KK di RT & RW
        $kkList = DB::table('master_kartukeluargas')
            ->where('rt', $rt)
            ->where('rw', $rw)
            ->pluck('no_kk');

        // Ambil semua penduduk berdasarkan KK
        $penduduk = DB::table('master_penduduks')
            ->whereIn('no_kk', $kkList);

        // Hitung jumlah penduduk
        $jumlahPenduduk = $penduduk->count();

        // Hitung jumlah KK
        $jumlahKK = DB::table('master_kartukeluargas')
            ->where('rt', $rt)
            ->where('rw', $rw)
            ->count();

        // Laki-laki
        $jumlahLaki = DB::table('master_penduduks')
            ->whereIn('no_kk', $kkList)
            ->whereRaw("LOWER(jenis_kelamin) LIKE '%laki%'")
            ->count();

        // Perempuan
        $jumlahWanita = DB::table('master_penduduks')
            ->whereIn('no_kk', $kkList)
            ->whereRaw("LOWER(jenis_kelamin) LIKE '%perempuan%'")
            ->count();

        // Ambil semua NIK dari penduduk RT
        $niks = DB::table('master_penduduks')
            ->whereIn('no_kk', $kkList)
            ->pluck('nik');

        // Surat Masuk
        $jumlahSuratMasuk = DB::table('master_pengajuan')
            ->whereIn('nik', $niks)
            ->where('status', 'Diajukan')
            ->count();

        // Surat Ditolak
        $jumlahSuratDitolak = DB::table('master_pengajuan')
            ->whereIn('nik', $niks)
            ->where('status', 'Ditolak')
            ->count();

        // Surat Selesai
        $jumlahSuratSelesai = DB::table('master_pengajuan')
            ->whereIn('nik', $niks)
            ->where('status', 'Selesai')
            ->count();

        return view('rt.dashboard', compact(
            'jumlahPenduduk',
            'jumlahKK',
            'jumlahLaki',
            'jumlahWanita',
            'jumlahSuratMasuk',
            'jumlahSuratDitolak',
            'jumlahSuratSelesai',
            'rt',
            'rw'
        ));
    }
}