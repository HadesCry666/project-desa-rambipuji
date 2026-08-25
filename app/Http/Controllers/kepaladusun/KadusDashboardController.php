<?php

namespace App\Http\Controllers\KepalaDusun;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KadusDashboardController extends Controller
{
    public function index()
    {
        $nikKadus = session('nik') ?? Auth::user()->nik;

        // Cari Dusun Kadus berdasarkan relasi Penduduk -> Kartu Keluarga
        $dusunKadus = DB::table('master_dusun') 
                ->where('nik', (string) $nikKadus)
                ->value('nama_dusun');

        // Helper Query: Filter hanya pengajuan dari warga di Dusun Kadus tersebut
        $queryDusun = function ($query) use ($dusunKadus) {
            $query->join('master_penduduks', 'master_pengajuan.nik', '=', 'master_penduduks.nik')
                  ->join('master_kartukeluargas', 'master_penduduks.no_kk', '=', 'master_kartukeluargas.no_kk')
                  ->where('master_kartukeluargas.dusun', $dusunKadus);
        };

        // 1. Surat Masuk (menunggu persetujuan Kadus)
        $suratMasuk = DB::table('master_pengajuan')
            ->where('status', 'Diajukan')
            ->count();

        // 2. Surat Diproses (sudah melewati Kadus, sedang dalam proses selanjutnya)
        $diproses = DB::table('master_pengajuan')
            ->whereIn('status', [
                'Disetujui Kepala Dusun',
                'Disetujui Admin',
                'Disetujui Sekretaris Desa',
            ])
            ->count();

        // 3. Surat Selesai
        $selesai = DB::table('master_pengajuan')
            ->where('status', 'Selesai')
            ->count();

        // 4. Surat Ditolak
        $ditolak = DB::table('master_pengajuan')
            ->where('status', 'Ditolak')
            ->count();

        // 5. Data Per Bulan (12 Bulan Tahun Ini)
        $tahun = Carbon::now()->year;
        $suratBulanDiajukan = [];
        $suratBulanSelesai  = [];

        for ($m = 1; $m <= 12; $m++) {
            $diajukanCount = DB::table('master_pengajuan')
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $m)
                ->count();

            $selesaiCount = DB::table('master_pengajuan')
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $m)
                ->where('status', 'Selesai')
                ->count();

            $suratBulanDiajukan[] = $diajukanCount;
            $suratBulanSelesai[]  = $selesaiCount;
        }

        return view('kepaladusun.dashboard.index', compact(
            'dusunKadus',
            'suratMasuk',
            'diproses',
            'selesai',
            'ditolak',
            'suratBulanDiajukan',
            'suratBulanSelesai'
        ));
    }
}
