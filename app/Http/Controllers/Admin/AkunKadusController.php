<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\master_akun;
use App\Models\master_dusun;
use App\Models\master_penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AkunKadusController extends Controller
{
    
    public function index(Request $request)
{
    $katakunci = $request->katakunci ?? '';
    $jumlahbaris = 10;

    $query = DB::table('master_akun')
        ->leftJoin('master_penduduks', 'master_akun.nik', '=', 'master_penduduks.nik')
        ->leftJoin( 'master_dusun', 'master_akun.nik', '=', 'master_dusun.nik')
        ->select('master_akun.*', 'master_penduduks.nama_lengkap', 'master_dusun.nama_dusun as dusun')
        ->where('master_akun.level', 2);

    if (!empty($katakunci)) {
        $query->where(function ($q) use ($katakunci) {
            $q->where('master_akun.nik', 'like', "%{$katakunci}%")
            ->orWhere('master_akun.email', 'like', "%{$katakunci}%")
            ->orWhere('master_akun.no_hp', 'like', "%{$katakunci}%")
            ->orWhere('master_penduduks.nama_lengkap', 'like', "%{$katakunci}%")
            ->orWhere('master_dusun.nama_dusun', 'like',"%{$katakunci}%");
        });
    }

    $dataakun = $query
        ->orderBy('master_akun.id', 'desc')->paginate($jumlahbaris)
        ->withQueryString();

    $datapenduduk = master_penduduk::orderBy('nama_lengkap')->get();
    $datadusun = master_dusun::orderBy('nama_dusun')->get();

    return view('admin.master_akun.kepala_dusun',compact('dataakun','datapenduduk','datadusun')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik'        => 'required|string|exists:master_penduduks,nik|unique:master_akun,nik',
            'email'      => 'required|email|unique:master_akun,email',
            'no_hp'      => 'required|string|max:15',
            'nama_dusun' => 'required|string|max:100|unique:master_dusun,nama_dusun',
            'password'   => 'nullable|string|min:6',
            
        ], [
            'nik.required'    => 'NIK Kepala Dusun wajib dipilih.',
            'nik.exists'      => 'NIK tidak terdaftar dalam data penduduk.',
            'nik.unique'      => 'NIK ini sudah memiliki akun di dalam sistem.',
            'email.required'  => 'Email wajib diisi.',
            'email.unique'    => 'Email sudah digunakan oleh akun lain.',
            'nama_dusun.unique' => 'Dusun ini sudah ada di dalam sistem.',
            'no_hp.required'  => 'Nomor HP wajib diisi.',
            'password.min'    => 'Password minimal 6 karakter.',
        ]);

        $penduduk = master_penduduk::where('nik', $request->nik)->firstOrFail();

        master_dusun::create([
            'nama_dusun' => $request->nama_dusun,
            'nik'        => $penduduk->nik,
            'nama_kasun' => $penduduk->nama_lengkap,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        master_akun::create([
            'nik'         => $request->nik,
            'email'       => $request->email,
            'no_hp'       => $request->no_hp,
            'foto_profil' => 'default.png',
            'level'       => 2, // Level 2 = Kepala Dusun
            'password' => Hash::make(
            $request->filled('password')
                ? $request->password
                : 'password123'
        ),
        ]);

        return redirect()->route('akunkadus.index')
            ->with('success', 'Akun Kepala Dusun berhasil ditambahkan.');
    }

   
    public function update(Request $request, $id)
{
    $akun = master_akun::findOrFail($id);

    $request->validate([
        'nik'      => 'required|exists:master_penduduks,nik',
        'email'    => 'required|email|unique:master_akun,email,' . $id,
        'no_hp'    => 'required|string|max:15',
        'password' => 'nullable|string|min:6',
    ], [
        'nik.required'    => 'NIK wajib dipilih.',
        'nik.exists'      => 'NIK tidak ditemukan di data penduduk.',
        'email.required'  => 'Email wajib diisi.',
        'email.unique'    => 'Email sudah digunakan oleh akun lain.',
        'no_hp.required'  => 'Nomor HP wajib diisi.',
        'password.min'    => 'Password minimal 6 karakter.',
    ]);

    // simpan NIK lama SEBELUM akun di-update
    $nikLama = $akun->nik;
    $nikBaru = $request->nik;

    DB::transaction(function () use ($akun, $request, $nikLama, $nikBaru) {
        $data = [
            'nik'   => $nikBaru,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $akun->update($data);

        // update juga di master_dusun kalau nik berubah
        if ($nikLama !== $nikBaru) {
            master_dusun::where('nik', $nikLama)->update(['nik' => $nikBaru]);
        }
    });

    return redirect()->route('akunkadus.index')
        ->with('success', 'Akun Kepala Dusun berhasil diperbarui.');
}

    /**
     * Hapus Akun Kepala Dusun
     */
    public function destroy($id)
{
    $akun = master_akun::where('id', $id)->where('level', 2)->first();

    if (!$akun) {
        return redirect()->route('akunkadus.index')
            ->with('error', 'Akun tidak ditemukan.');
    }

    DB::transaction(function () use ($akun) {
        // hapus data dusun yang terkait NIK akun ini
        master_dusun::where('nik', $akun->nik)->delete();

        // jangan hapus akun, cukup ubah level jadi 5
        $akun->update(['level' => 5]);
    });

    return redirect()->route('akunkadus.index')
        ->with('success', 'Akun Kepala Dusun berhasil dihapus dari daftar dusun.');
}
}
