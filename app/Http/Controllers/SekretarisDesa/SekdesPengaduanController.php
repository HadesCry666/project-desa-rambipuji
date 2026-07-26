<?php

namespace App\Http\Controllers\SekretarisDesa;

use App\Http\Controllers\Controller;
use App\Models\master_pengaduan;
use Illuminate\Http\Request;

class SekdesPengaduanController extends Controller
{
    /**
     * Sekretaris Desa hanya dapat melihat pengaduan dan feedback Admin (Read-Only).
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;

        $query = master_pengaduan::with('penduduk');

        if (!empty($katakunci)) {
            $query->where(function ($q) use ($katakunci) {
                $q->where('nik', 'like', "%$katakunci%")
                  ->orWhere('kategori', 'like', "%$katakunci%")
                  ->orWhere('ulasan', 'like', "%$katakunci%")
                  ->orWhereHas('penduduk', function ($q2) use ($katakunci) {
                      $q2->where('nama_lengkap', 'like', "%$katakunci%");
                  });
            });
        }

        $pengaduan = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->query());

        return view('sekretarisdesa.pengaduan.index', compact('pengaduan'));
    }
}
