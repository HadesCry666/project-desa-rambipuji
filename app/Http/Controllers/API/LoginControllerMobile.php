<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\master_akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LoginControllerMobile extends Controller
{
    /**
     * Aktivasi akun baru untuk warga (level 5).
     * NIK harus terdaftar di master_penduduks dan belum pernah diaktivasi.
     */
    public function register(Request $request)
    {
        $nik = $request->nik;

        // 1. Cek apakah NIK ada di master_penduduks
        $penduduk = DB::table('master_penduduks')->where('nik', $nik)->first();
        if (!$penduduk) {
            return response()->json([
                'status' => 'error',
                'message' => 'NIK tidak ditemukan dalam data penduduk.',
            ], 404);
        }

        // 2. Cek apakah NIK sudah ada di master_akun (sudah diaktivasi)
        $existingAkun = master_akun::where('nik', $nik)->first();
        if ($existingAkun) {
            return response()->json([
                'status' => 'error',
                'message' => 'NIK sudah diaktivasi, silahkan login.',
            ], 409);
        }

        // 3. Validasi input
        $validator = Validator::make($request->all(), [
            'nik'      => 'required|string|size:16',
            'email'    => 'required|email|unique:master_akun,email',
            'no_hp'    => 'required|min:10|unique:master_akun,no_hp',
            'password' => [
                'required',
                'string',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/',
            ],
        ], [
            'nik.size'        => 'NIK harus terdiri dari 16 digit.',
            'email.email'     => 'Format email tidak valid.',
            'email.unique'    => 'Email sudah digunakan, silakan gunakan email lain.',
            'no_hp.min'       => 'Nomor HP minimal harus terdiri dari 10 digit.',
            'no_hp.unique'    => 'Nomor HP sudah digunakan, silakan gunakan nomor lain.',
            'password.regex'  => 'Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validasi gagal.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // 4. Simpan akun dengan level 5 (warga)
        try {
            $user = master_akun::create([
                'nik'         => $nik,
                'email'       => $request->email,
                'password'    => Hash::make($request->password),
                'no_hp'       => $request->no_hp,
                'level'       => 5,
                'id_penduduk' => $penduduk->id_penduduk ?? null,
            ]);

            return response()->json([
                'status'  => 'success',
                'message' => 'Akun berhasil diaktivasi. Silakan login.',
                'data'    => [
                    'nik'   => $user->nik,
                    'email' => $user->email,
                    'no_hp' => $user->no_hp,
                ],
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status'       => 'error',
                'message'      => 'Gagal mengaktivasi akun, coba lagi.',
                'error_detail' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Login Multi-Role untuk aplikasi Mobile:
     * - Admin Desa (level 1)
     * - Kepala Dusun (level 2)
     * - Sekretaris Desa (level 3)
     * - Kepala Desa (level 4)
     * - Warga (level 5)
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik'      => 'required|string',
            'password' => 'required|string',
        ], [
            'nik.required'      => 'NIK / Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validasi gagal.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Cek user berdasarkan NIK atau Email
        $user = master_akun::where('nik', $request->nik)
            ->orWhere('email', $request->nik)
            ->first();

        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Akun tidak terdaftar, silakan melakukan aktivasi terlebih dahulu.',
            ], 404);
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Password salah.',
            ], 401);
        }

        // Admin Desa (level 1) hanya boleh login dari Website
        if ((int)$user->level === 1) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Akun Admin Desa hanya dapat digunakan melalui Website.',
            ], 403);
        }

        // Tentukan role_name berdasarkan level
        // Level 1 = Admin, Level 2 = Kadus, Level 3 = Sekdes, Level 4 = Kades, Level 5 = Warga
        $level = (int)$user->level;
        $roleName = 'warga';

        if ($level === 1) {
            $roleName = 'admin';
        } elseif ($level === 2) {
            $roleName = 'kepala_dusun';
        } elseif ($level === 3) {
            $roleName = 'sekretaris_desa';
        } elseif ($level === 4) {
            $roleName = 'kepala_desa';
        } elseif ($level === 5) {
            $roleName = 'warga';
        }

        // Hapus token lama
        $user->tokens()->delete();

        // Buat token baru
        $token = $user->createToken('mobile-token')->plainTextToken;

        // Ambil data penduduk
        $penduduk = DB::table('master_penduduks')->where('nik', $user->nik)->first();
        $namaLengkap = $penduduk->nama_lengkap ?? 'Pengguna';

        $fotoProfil = $user->foto_profil
            ? asset('storage/foto_profil/' . $user->foto_profil)
            : asset('storage/foto_profil/default.jpg');

        return response()->json([
            'status'  => 'success',
            'message' => 'Selamat Datang, ' . $namaLengkap . '!',
            'data'    => [
                'nik'         => $user->nik,
                'nama'        => $namaLengkap,
                'email'       => $user->email,
                'no_hp'       => $user->no_hp,
                'level'       => $level,
                'role_name'   => $roleName,
                'foto_profil' => $fotoProfil,
                'token'       => $token,
            ],
        ], 200);
    }

    /**
     * Logout.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Berhasil logout.',
        ], 200);
    }
}