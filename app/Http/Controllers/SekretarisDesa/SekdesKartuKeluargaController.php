<?php

namespace App\Http\Controllers\SekretarisDesa;

use App\Http\Controllers\Controller;
use App\Models\master_kartukeluarga;
use App\Models\master_penduduk;
use Illuminate\Http\Request;

class SekdesKartuKeluargaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->katakunci;

        $query = master_penduduk::join(
            'master_kartukeluargas',
            'master_penduduks.no_kk', '=', 'master_kartukeluargas.no_kk'
        )->select(
            'master_kartukeluargas.kecamatan',
            'master_kartukeluargas.desa',
            'master_kartukeluargas.no_kk',
            'master_penduduks.nik',
            'master_penduduks.nama_lengkap',
            'master_penduduks.tempat_lahir',
            'master_penduduks.tanggal_lahir',
            'master_penduduks.status_perkawinan',
            'master_penduduks.jenis_kelamin',
            'master_kartukeluargas.alamat',
            'master_kartukeluargas.rt',
            'master_kartukeluargas.rw',
            'master_kartukeluargas.kode_pos',
            'master_kartukeluargas.kabupaten',
            'master_kartukeluargas.provinsi'
        )->orderBy('master_kartukeluargas.no_kk')
         ->orderByRaw("FIELD(master_penduduks.status_keluarga, 'KEPALA KELUARGA', 'Kepala Keluarga', 'SUAMI', 'ISTRI', 'ANAK')");

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('master_kartukeluargas.no_kk', 'LIKE', '%' . $keyword . '%')
                  ->orWhere('master_penduduks.nik', 'LIKE', '%' . $keyword . '%')
                  ->orWhere('master_penduduks.nama_lengkap', 'LIKE', '%' . $keyword . '%');
            });
        }

        $master_kartukeluarga = $query->paginate(15);

        return view('sekretarisdesa.master_kartukeluarga.index', compact('master_kartukeluarga'));
    }

    public function delete($no_kk)
    {
        master_penduduk::where('no_kk', $no_kk)->delete();
        master_kartukeluarga::where('no_kk', $no_kk)->delete();

        return redirect()->route('sekdes.kartukeluarga.index')
            ->with('success', 'Data Kartu Keluarga dan anggotanya berhasil dihapus.');
    }
}

