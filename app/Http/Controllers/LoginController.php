<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\master_akun;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        Log::info('Menampilkan halaman login');
        return view('auth.login');
    }

    public function login(Request $request)
    {
        Log::info('Proses login dimulai', ['nik' => $request->nik]);

        $request->validate([
            'nik' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek user berdasarkan NIK atau Email
        $user = master_akun::where('nik', $request->nik)
            ->orWhere('email', $request->nik)
            ->first();

        if (!$user) {
            Log::warning('Login gagal: user tidak ditemukan', ['input' => $request->nik]);
            return back()->with('error', 'NIK/Email atau Password salah');
        }

        Log::info('User ditemukan', [
            'nik' => $user->nik,
            'level' => $user->level
        ]);

        // cek password
        if (!Hash::check($request->password, $user->password)) {
            Log::warning('Login gagal: password salah', ['nik' => $user->nik]);
            return back()->with('error', 'NIK/Email atau Password salah');
        }

        // login user
        Auth::login($user);

        // regenerate session (penting untuk auth)
        $request->session()->regenerate();

        Log::info('User berhasil login', ['nik' => $user->nik]);

        // ambil nama dari tabel penduduk
        $penduduk = DB::table('master_penduduks')
            ->where('nik', $user->nik)
            ->first();

        $nama = $penduduk ? $penduduk->nama_lengkap : $user->nik;

        session(['nama' => $nama]);

        Log::info('Nama disimpan di session', ['nama' => $nama]);

        // redirect sesuai level akun
        switch ($user->level) {

            case 1:
                Log::info('Redirect ke dashboard admin');
                return redirect('/admin/dashboard')
                    ->with('success', 'Login sebagai Admin Desa');

            case 2:
                Log::info('Redirect ke dashboard Kepala Dusun');
                return redirect('/kepaladusun/dashboard')
                    ->with('success', 'Login sebagai Kepala Dusun');

            case 3:
                Log::info('Redirect ke dashboard Sekretaris Desa');
                return redirect('/sekretarisdesa/dashboard')
                    ->with('success', 'Login sebagai Sekretaris Desa');

            case 4:
                Log::info('Redirect ke dashboard Kepala Desa');
                return redirect('/kepaladesa/dashboard')
                    ->with('success', 'Login sebagai Kepala Desa');

            case 5:
                Log::info('Redirect ke dashboard Warga');
                return redirect('/')
                    ->with('success', 'Login sebagai Warga');

            default:
                Auth::logout();
                Log::error('Level akun tidak dikenali', ['level' => $user->level]);

                return redirect()->route('login')
                    ->with('error', 'Level akun tidak dikenali');
        }
    }

    public function logout(Request $request)
    {
        Log::info('Logout user', [
            'nik' => optional(Auth::user())->nik
        ]);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Berhasil logout');
    }

    public function getNama()
    {
        if (Auth::check()) {

            $user = Auth::user();

            $nama = DB::table('master_penduduks')
                ->where('nik', $user->nik)
                ->value('nama_lengkap');

            return $nama ?? $user->nik;
        }

        return null;
    }
}   