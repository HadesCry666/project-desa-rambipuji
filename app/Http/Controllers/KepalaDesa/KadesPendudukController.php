<?php

namespace App\Http\Controllers\KepalaDesa;

use App\Http\Controllers\Controller;
use App\Models\master_penduduk;
use Illuminate\Http\Request;

class KadesPendudukController extends Controller
{
    public function index(Request $request)
    {
        $no_kk = $request->nokk;

        $query = master_penduduk::query();

        if (!empty($no_kk)) {
            $query->where('no_kk', $no_kk);
        }

        if (!empty($request->katakunci)) {
            $query->where(function ($q) use ($request) {
                $q->where('nik', 'LIKE', '%' . $request->katakunci . '%')
                  ->orWhere('nama_lengkap', 'LIKE', '%' . $request->katakunci . '%');
            });
        }

        $master_penduduk = $query->paginate(10);

        return view('kepaladesa.master_penduduk.index', compact('master_penduduk', 'no_kk'));
    }
}
