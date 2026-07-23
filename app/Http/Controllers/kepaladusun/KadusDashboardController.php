<?php

namespace App\Http\Controllers\KepalaDusun;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KadusDashboardController extends Controller
{
    public function index()
    {
        // 1. Total Pengajuan
        $totalPengajuan = DB::table('master_pengajuan')->count();

        // 2. Menunggu Persetujuan Kadus (status = Diajukan)
        $menunggu = DB::table('master_pengajuan')
            ->where('status', 'Diajukan')
            ->count();

        // 3. Surat Selesai
        $selesai = DB::table('master_pengajuan')
            ->where('status', 'Selesai')
            ->count();

        // 4. Surat Ditolak
        $ditolak = DB::table('master_pengajuan')
            ->where('status', 'like', '%Ditolak%')
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
            'totalPengajuan',
            'menunggu',
            'selesai',
            'ditolak',
            'suratBulanDiajukan',
            'suratBulanSelesai'
        ));
    }
}
