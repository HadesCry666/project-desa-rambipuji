<?php

namespace App\Http\Controllers\SekretarisDesa;

use App\Http\Controllers\Controller;
use App\Models\View_data_pengajuan;
use Illuminate\Http\Request;

class SekdesSuratSelesaiController extends Controller
{
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;

        $query = View_data_pengajuan::whereIn('status', ['Selesai', 'Disetujui Sekdes', 'Disetujui Sekretaris Desa']);

        if (!empty($katakunci)) {
            $query->where(function ($q) use ($katakunci) {
                $q->where('nik', 'like', "%$katakunci%")
                  ->orWhere('nama_lengkap', 'like', "%$katakunci%")
                  ->orWhere('nama_surat', 'like', "%$katakunci%");
            });
        }

        $datapengajuan = $query->orderBy('id_pengajuan', 'desc')->paginate(10)->appends($request->query());

        return view('sekretarisdesa.suratselesai.index', compact('datapengajuan'));
    }
}
