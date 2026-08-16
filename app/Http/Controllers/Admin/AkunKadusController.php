<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\master_akun;
use App\Models\master_penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AkunKadusController extends Controller
{
    /**
     * Tampilkan daftar Akun Kepala Dusun (Level = 2)
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci ?? '';
        $jumlahbaris = 10;

        $query = DB::table('master_akun')
            ->leftJoin('master_penduduks', 'master_akun.nik', '=', 'master_penduduks.nik')
            ->select('master_akun.*', 'master_penduduks.nama_lengkap')
            ->where('master_akun.level', 2);

        if (!empty($katakunci)) {
            $query->where(function ($q) use ($katakunci) {
                $q->where('master_akun.nik', 'like', "%$katakunci%")
                  ->orWhere('master_akun.email', 'like', "%$katakunci%")
                  ->orWhere('master_akun.no_hp', 'like', "%$katakunci%")
                  ->orWhere('master_penduduks.nama_lengkap', 'like', "%$katakunci%");
            });
        }

        $dataakun = $query->orderBy('master_akun.id', 'desc')->paginate($jumlahbaris);

        // Ambil data penduduk untuk opsi dropdown saat tambah akun
        $datapenduduk = master_penduduk::orderBy('nama_lengkap')->get();

        return view('admin.master_akun.kepala_dusun', compact('dataakun', 'datapenduduk'));
    }

    /**
     * Simpan Akun Kepala Dusun Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik'      => 'required|string|exists:master_penduduks,nik|unique:master_akun,nik',
            'email'    => 'required|email|unique:master_akun,email',
            'no_hp'    => 'required|string|max:15',
            'password' => 'required|string|min:6',
        ], [
            'nik.required'    => 'NIK Kepala Dusun wajib dipilih.',
            'nik.exists'      => 'NIK tidak terdaftar dalam data penduduk.',
            'nik.unique'      => 'NIK ini sudah memiliki akun di dalam sistem.',
            'email.required'  => 'Email wajib diisi.',
            'email.unique'    => 'Email sudah digunakan oleh akun lain.',
            'no_hp.required'  => 'Nomor HP wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min'    => 'Password minimal 6 karakter.',
        ]);

        master_akun::create([
            'nik'         => $request->nik,
            'email'       => $request->email,
            'no_hp'       => $request->no_hp,
            'foto_profil' => 'default.png',
            'level'       => 2, // Level 2 = Kepala Dusun
            'password'    => Hash::make($request->password),
        ]);

        return redirect()->route('akunkadus.index')
            ->with('success', 'Akun Kepala Dusun berhasil ditambahkan.');
    }

    /**
     * Update Data Akun Kepala Dusun
     */
    public function update(Request $request, $id)
    {
        $akun = master_akun::findOrFail($id);

        $request->validate([
            'email'    => 'required|email|unique:master_akun,email,' . $id,
            'no_hp'    => 'required|string|max:15',
            'password' => 'nullable|string|min:6',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.unique'   => 'Email sudah digunakan oleh akun lain.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'password.min'   => 'Password minimal 6 karakter.',
        ]);

        $data = [
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $akun->update($data);

        return redirect()->route('akunkadus.index')
            ->with('success', 'Akun Kepala Dusun berhasil diperbarui.');
    }

    /**
     * Hapus Akun Kepala Dusun
     */
    public function destroy($id)
    {
        $akun = master_akun::where('id', $id)->where('level', 2)->first();

        if ($akun) {
            $akun->delete();
            return redirect()->route('akunkadus.index')
                ->with('success', 'Akun Kepala Dusun berhasil dihapus.');
        }

        return redirect()->route('akunkadus.index')
            ->with('error', 'Akun tidak ditemukan.');
    }
}
