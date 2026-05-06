<?php

namespace App\Http\Controllers\API;

use App\Models\master_akun;
use App\Models\master_penduduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;



class ProfileControllerMobile extends Controller
{
    public function index(Request $request)
    {
        $nik = $request->query('nik');

        if (!$nik) {
            return response()->json([
                'error' => 'Parameter NIK tidak ditemukan'
            ], 400);
        }

        $profil = DB::table('master_penduduks')
            ->leftJoin('master_akun', 'master_penduduks.nik', '=', 'master_akun.nik')
            ->select(
                'master_penduduks.no_kk',
                'master_penduduks.nik',
                'master_penduduks.nama_lengkap',
                'master_akun.no_hp',
                'master_akun.email',
                'master_akun.foto_profil'
            )
            ->where('master_penduduks.nik', $nik)
            ->first();

        if (!$profil) {
            return response()->json([
                'error' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'no_kk' => $profil->no_kk,
                'nik' => $profil->nik,
                'nama_lengkap' => $profil->nama_lengkap,
                'no_hp' => $profil->no_hp,
                'email' => $profil->email,
                'foto_profil' => $profil->foto_profil
                        ? asset('storage/foto_profil/' . $profil->foto_profil)
                        : asset('storage/foto_profil/default.jpg'),

            ]
        ]);

    }

    public function getByNik(Request $request)
    {
        $nik = $request->query('nik');
        $user = master_penduduk::where('nik', $nik)->first();

        if ($user) {
            return response()->json([
                'success' => true,
                'data' => [
                    'nama' => $user->nama_lengkap,
                    'nik' => $user->nik,
                    'tempatLahir' => $user->tempat_lahir,
                    'tanggalLahir' => $user->tanggal_lahir,
                    'golDarah' => $user->golongan_darah,
                    'jk' => $user->jenis_kelamin,
                    'kewarganegaraan' => $user->kewarganegaraan,
                    'agama' => $user->agama,
                    'statusKeluarga' => $user->status_keluarga,
                    'pekerjaan' => $user->pekerjaan,
                    'pendidikan' => $user->pendidikan,
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User dengan NIK tersebut tidak ditemukan.'
            ], 404);
        }
    }

    public function updateFoto(Request $request)
{
    try {
        // Validasi input
        $request->validate([
            'nik' => 'required|exists:master_akun,nik',
            'foto_profil' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        
        $file = $request->file('foto_profil');
        if (!$file) {
            return response()->json([
                'status' => 'error',
                'message' => 'File foto_profil tidak ditemukan',
            ], 400);
        }

        $user = master_akun::where('nik', $request->nik)->first();

        // Generate nama file random + ekstensi asli
        $extension = $file->getClientOriginalExtension();
        $randomName = Str::random(40) . '.' . $extension;

        // Simpan file dengan nama baru ke folder public/foto_profil
        $path = $file->storeAs('public/foto_profil', $randomName);

        // Hapus foto lama jika ada
        if ($user->foto_profil && Storage::exists('public/foto_profil/' . $user->foto_profil)) {
            Storage::delete('public/foto_profil/' . $user->foto_profil);
        }

        // Simpan nama file random ke database
        $user->foto_profil = $randomName;
        $user->save();

        return response()->json([
            'status' => 'success',
            'foto_url' => Storage::url('public/foto_profil/' . $randomName),
        ], 200);

    } catch (ValidationException $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validasi gagal',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
}

public function updateEmailNoHp(Request $request)
{
    try {
        // Validasi input: nik wajib, email & no_hp boleh nullable
        $request->validate([
            'nik' => 'required|exists:master_akun,nik',
            'email' => 'nullable|email',
            'no_hp' => 'nullable|string|max:20',
        ]);

        // Cari user berdasarkan nik
        $user = master_akun::where('nik', $request->nik)->first();

        // Variabel untuk menandai perubahan
        $updatedFields = [];

        // Update email jika ada dan berbeda
        if ($request->has('email') && $request->email !== $user->email) {
            $user->email = $request->email;
            $updatedFields[] = 'email';
        }

        // Update no_hp jika ada dan berbeda
        if ($request->has('no_hp') && $request->no_hp !== $user->no_hp) {
            $user->no_hp = $request->no_hp;
            $updatedFields[] = 'no_hp';
        }

        // Jika tidak ada perubahan
        if (empty($updatedFields)) {
            return response()->json([
                'status' => 'info',
                'message' => 'Tidak ada data yang diubah.',
            ], 200);
        }

        // Simpan perubahan
        $user->save();

        // Siapkan pesan sesuai perubahan
        if (count($updatedFields) == 2) {
            $message = 'Email dan No HP berhasil diperbarui.';
        } elseif ($updatedFields[0] == 'email') {
            $message = 'Email berhasil diperbarui.';
        } else {
            $message = 'No HP berhasil diperbarui.';
        }

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => [
                'email' => $user->email,
                'no_hp' => $user->no_hp,
            ],
        ], 200);

    } catch (ValidationException $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validasi gagal',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
}

}