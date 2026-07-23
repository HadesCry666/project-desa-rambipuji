<?php

namespace App\Http\Controllers\SekretarisDesa;

use App\Http\Controllers\Controller;
use App\Models\master_kartukeluarga;
use Illuminate\Http\Request;

class SekdesKartuKeluargaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->katakunci;

        $query = master_kartukeluarga::leftJoin(
            'master_penduduks',
            function ($join) {
                $join->on('master_kartukeluargas.no_kk', '=', 'master_penduduks.no_kk')
                    ->where(function ($q) {
                        $q->where('master_penduduks.status_keluarga', 'LIKE', '%KEPALA KELUARGA%')
                          ->orWhere('master_penduduks.status_keluarga', 'LIKE', '%Kepala Keluarga%');
                    });
            }
        )->select(
            'master_kartukeluargas.no_kk',
            'master_kartukeluargas.alamat',
            'master_kartukeluargas.rt',
            'master_kartukeluargas.rw',
            'master_kartukeluargas.kode_pos',
            'master_kartukeluargas.desa',
            'master_kartukeluargas.kecamatan',
            'master_kartukeluargas.kabupaten',
            'master_kartukeluargas.provinsi',
            'master_kartukeluargas.tanggal_dibuat',
            'master_penduduks.nama_lengkap',
            'master_penduduks.nik'
        );

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('master_kartukeluargas.no_kk', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('master_penduduks.nama_lengkap', 'LIKE', '%' . $keyword . '%');
            });
        }

        $master_kartukeluarga = $query->paginate(10);

        return view('sekretarisdesa.master_kartukeluarga.index', compact('master_kartukeluarga'));
    }
}
