<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\master_pengaduan;
use App\Models\master_penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
   public function index(Request $request)
{
    $katakunci = $request->katakunci;
    $sort = $request->get('sort', 'terbaru');

    $query = master_pengaduan::with('penduduk');

    if ($katakunci) {
        $query->where(function ($q) use ($katakunci) {
            $q->where('nik', 'like', "%$katakunci%")
              ->orWhere('kategori', 'like', "%$katakunci%")
              ->orWhere('ulasan', 'like', "%$katakunci%")
              ->orWhereHas('penduduk', function ($q2) use ($katakunci) {
                  $q2->where('nama_lengkap', 'like', "%$katakunci%");
              });
        });
    }

    if ($sort == 'terlama') {
        $query->orderBy('created_at', 'asc');
    } else {
        $query->orderBy('created_at', 'desc');
    }

    $pengaduan = $query->paginate(10)->appends($request->query());

    return view('admin.pengaduan.index', compact('pengaduan'));
}


    public function show($id)
    {
        $pengaduan = master_pengaduan::with('penduduk')->findOrFail($id);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    
    public function destroy($id)
    {
        $pengaduan = master_pengaduan::findOrFail($id);

        if ($pengaduan->foto1 && Storage::disk('public')->exists($pengaduan->foto1)) {
            Storage::disk('public')->delete($pengaduan->foto1);
        }

        $pengaduan->delete();

        return back()->with('success', 'Pengaduan berhasil dihapus.');
    }

    public function feedback(Request $request, $id)
{
    $pengaduan = master_pengaduan::findOrFail($id);

    $request->validate([
        'feedback' => 'required|string|max:1000',
    ]);

    $pengaduan->feedback = $request->feedback;
    $pengaduan->save();

    return redirect()->route('master-pengaduan.index')->with('success', 'Feedback berhasil dikirim.');
}

}