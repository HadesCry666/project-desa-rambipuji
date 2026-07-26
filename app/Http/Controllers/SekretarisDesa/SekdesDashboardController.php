<?php

namespace App\Http\Controllers\SekretarisDesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SekdesDashboardController extends Controller
{
    public function index()
    {
        // 1. Menunggu Persetujuan Sekdes (status = Disetujui Admin)
        $menunggu = DB::table('master_pengajuan')
            ->where('status', 'Disetujui Admin')
            ->count();

        // 2. Surat Selesai
        $selesai = DB::table('master_pengajuan')
            ->where('status', 'Selesai')
            ->count();

        // 3. Surat Ditolak
        $ditolak = DB::table('master_pengajuan')
            ->where('status', 'Ditolak')
            ->count();

        // 5. Data Per Bulan (12 Bulan Tahun Ini)
        $tahun = Carbon::now()->year;
        $suratBulanMasuk    = [];
        $suratBulanDisetujui = [];

        for ($m = 1; $m <= 12; $m++) {
            $masukCount = DB::table('master_pengajuan')
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $m)
                ->count();

            $disetujuiCount = DB::table('master_pengajuan')
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $m)
                ->whereIn('status', ['Disetujui Sekretaris Desa', 'Selesai'])
                ->count();

            $suratBulanMasuk[]    = $masukCount;
            $suratBulanDisetujui[] = $disetujuiCount;
        }

        return view('sekretarisdesa.dashboard.index', compact(
            'menunggu',
            'selesai',
            'ditolak',
            'suratBulanMasuk',
            'suratBulanDisetujui'
        ));
    }
}
