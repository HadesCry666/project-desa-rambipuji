<?php

namespace App\Http\Controllers\KepalaDesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KadesDashboardController extends Controller
{
    public function index()
    {
        // 1. Total Pengajuan
        $totalPengajuan = DB::table('master_pengajuan')->count();

        // 2. Menunggu TTE Kades (status = Disetujui Sekretaris Desa)
        $menunggu = DB::table('master_pengajuan')
            ->where('status', 'Disetujui Sekretaris Desa')
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
        $suratBulanDisahkan = [];

        for ($m = 1; $m <= 12; $m++) {
            $diajukanCount = DB::table('master_pengajuan')
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $m)
                ->count();

            $disahkanCount = DB::table('master_pengajuan')
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $m)
                ->where('status', 'Selesai')
                ->count();

            $suratBulanDiajukan[] = $diajukanCount;
            $suratBulanDisahkan[] = $disahkanCount;
        }

        return view('kepaladesa.dashboard.index', compact(
            'totalPengajuan',
            'menunggu',
            'selesai',
            'ditolak',
            'suratBulanDiajukan',
            'suratBulanDisahkan'
        ));
    }
}
