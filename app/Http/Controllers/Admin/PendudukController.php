<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\master_penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    // Menampilkan daftar data dengan fitur pencarian
    public function index(Request $request)
    {
    $query = master_penduduk::query();

    // Jika ada filter berdasarkan no_kk
    if ($request->has('nokk')) {
        $query->where('no_kk', $request->nokk);
    }

    $query->orderBy('no_kk')
          ->orderByRaw("FIELD(status_keluarga, 'Kepala Keluarga', 'Suami', 'Istri', 'Anak', 'Menantu', 'Orang Tua', 'Mertua', 'Pembantu', 'Famili lain')");

    $master_penduduk = $query->paginate(10); // atau sesuaikan jumlah per halaman

    return view('admin.master_penduduk.index', compact('master_penduduk'));
}


    // Menampilkan form tambah data
    public function tambah()
    {
        return view('admin.master_penduduk.tambah');
    }

    // Memasukkan data baru ke dalam master$master_pendudukase
   public function masuk(Request $request)
{
    $request->validate([
        'nik' => 'required|digits:16|numeric|unique:master_penduduks,nik',
        'nama_lengkap' => 'required',
        'jenis_kelamin' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required|date',
        'agama' => 'required',
        'pendidikan' => 'required',
        'pekerjaan' => 'required',
        'golongan_darah' => 'nullable',
        'status_perkawinan' => 'required',
        'status_keluarga' => 'required',
        'kewarganegaraan' => 'required',
        'no_kk' => 'required|exists:master_kartukeluargas,no_kk',
    ], [

        // ERROR NIK
        'nik.required' => 'NIK wajib diisi',
        'nik.digits' => 'NIK harus 16 digit',
        'nik.unique' => 'NIK sudah digunakan',

    ]);

    master_penduduk::create($request->all());

    return redirect()->back()
        ->with('success', 'Anggota keluarga berhasil ditambahkan.');
}


    // Mengupdate data berdasarkan NIK
    public function update(Request $request, $nik_lama)
{
    // Ambil data penduduk lama
    $pendudukLama = master_penduduk::find($nik_lama);

    if (!$pendudukLama) {
        return redirect()->back()->with('error', 'Data penduduk tidak ditemukan.');
    }

    // Validasi input dengan pengecualian berdasarkan data lama
    $request->validate([
        'nik' => 'required|digits:16|unique:master_penduduks,nik,' . $pendudukLama->nik . ',nik',
        'nama_lengkap' => 'required|string|max:50',
        'jenis_kelamin' => 'nullable|string|max:15',
        'tempat_lahir' => 'nullable|string|max:30',
        'tanggal_lahir' => 'nullable|date',
        'agama' => 'nullable|string|max:20',
        'pendidikan' => 'nullable|string|max:50',
        'pekerjaan' => 'nullable|string|max:50',
        'golongan_darah' => 'nullable|string|max:3',
        'status_perkawinan' => 'nullable|string|max:20',
        'status_keluarga' => 'nullable|string|max:20',
        'kewarganegaraan' => 'nullable|string|max:5',
        
    ]);
    $no_kk = $pendudukLama->no_kk;

    // Update data penduduk
    master_penduduk::where('nik', $nik_lama)->update([
        'nik' => $request->nik,
        'nama_lengkap' => $request->nama_lengkap,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'agama' => $request->agama,
        'pendidikan' => $request->pendidikan,
        'pekerjaan' => $request->pekerjaan,
        'golongan_darah' => $request->golongan_darah,
        'status_perkawinan' => $request->status_perkawinan,
        'status_keluarga' => $request->status_keluarga,
        'kewarganegaraan' => $request->kewarganegaraan,
       
    ]);

    return redirect()->to('admin/master_penduduk?nokk=' . $no_kk)->with('success', 'Data penduduk berhasil diperbarui');
}


    // Menghapus data berdasarkan NIK
    public function delete($nik)
{
    // Ambil data dulu sebelum dihapus, supaya bisa dapat no_kk-nya
    $penduduk = master_penduduk::where('nik', $nik)->first();

    if (!$penduduk) {
        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    $no_kk = $penduduk->no_kk;

    // Hapus data
    $penduduk->delete();

    // Redirect dengan membawa parameter nokk
    return redirect()->to('admin/master_penduduk?nokk=' . $no_kk)->with('success', 'Data penduduk berhasil dihapus.');
}
}
