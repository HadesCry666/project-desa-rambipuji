<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\LoginControllerMobile;
use App\Http\Controllers\API\BeritaControllerMobile;
use App\Http\Controllers\API\ProfileControllerMobile;
use App\Http\Controllers\API\PengajuanControllerMobile;
use App\Http\Controllers\API\PengaduanControllerMobile;
use App\Http\Controllers\API\NotifikasiControllerMobile;
use App\Http\Controllers\API\StatusSelesaiControllerMobile;
use App\Http\Controllers\API\StatusDitolakControllerMobile;
use App\Http\Controllers\API\ResetPasswordControllerMobile;
use App\Http\Controllers\API\StatusDiajukanControllerMobile;
use App\Http\Controllers\API\ForgotPasswordControllerMobile;
use App\Http\Controllers\API\SuratController;
use App\Http\Controllers\API\ChatbotController;
use App\Http\Controllers\API\KadusControllerMobile;
use App\Http\Controllers\API\SekdesControllerMobile;
use App\Http\Controllers\API\KadesControllerMobile;

// =========================================================
// 🔓 PUBLIC ROUTES — Tidak perlu token (autentikasi)
// =========================================================
Route::middleware('api')->group(function () {

    // Auth
    Route::post('/register', [LoginControllerMobile::class, 'register']);
    Route::post('/login', [LoginControllerMobile::class, 'login']);

    // Forgot & Reset Password via OTP WhatsApp
    Route::post('/forgot-password', [ForgotPasswordControllerMobile::class, 'sendResetOtpWhatsApp']);
    Route::post('/verify-otp', [ResetPasswordControllerMobile::class, 'verify'])->name('password.otp');
    Route::post('/reset-password', [ResetPasswordControllerMobile::class, 'reset'])->name('password.reset');

    // Berita Desa (publik, tidak perlu login)
    Route::get('/berita', [BeritaControllerMobile::class, 'index']);
    Route::get('/berita/{id}', [BeritaControllerMobile::class, 'show']);

    // Chatbot Surat (publik, untuk informasi syarat surat)
    Route::get('/surat-chatbot', [ChatbotController::class, 'index']);
    Route::post('/surat-chatbot/cek', [ChatbotController::class, 'cekPertanyaan']);
});

// =========================================================
// 🔐 PROTECTED ROUTES — Wajib Bearer Token (Sanctum)
// =========================================================
Route::middleware(['auth:sanctum'])->group(function () {

    // Auth
    Route::post('/logout', [LoginControllerMobile::class, 'logout']);

    // Daftar Jenis Surat (hanya untuk user yang sudah login)
    Route::get('/surat', [SuratController::class, 'index']);

    // Profil & Data Kependudukan
    Route::get('/getprofil', [ProfileControllerMobile::class, 'index']);
    Route::get('/getdata', [ProfileControllerMobile::class, 'getByNik']);
    Route::post('/update-foto', [ProfileControllerMobile::class, 'updateFoto']);
    Route::post('/update-profil', [ProfileControllerMobile::class, 'updateEmailNoHp']);

    // =====================================================
    // 👤 ROLE 1: WARGA
    // =====================================================
    Route::post('/pengajuan', [PengajuanControllerMobile::class, 'store']);
    Route::delete('/suratdelete/{id}', [StatusDiajukanControllerMobile::class, 'destroy']);
    Route::get('/statusdiajukan', [StatusDiajukanControllerMobile::class, 'index']);
    Route::get('/statusditolak', [StatusDitolakControllerMobile::class, 'index']);
    Route::get('/statusselesai', [StatusSelesaiControllerMobile::class, 'index']);
    Route::post('/pengaduan', [PengaduanControllerMobile::class, 'store']);
    Route::get('/notifikasi', [NotifikasiControllerMobile::class, 'index']);
    Route::get('/notifikasi/{id}', [NotifikasiControllerMobile::class, 'show']);
    Route::post('/notifikasi/{id}/read', [NotifikasiControllerMobile::class, 'markAsRead']);

    // =====================================================
    // 🏡 ROLE 2: KEPALA DUSUN (KADUS)
    // =====================================================
    Route::prefix('kadus')->group(function () {
        Route::get('/dashboard', [KadusControllerMobile::class, 'dashboard']);
        Route::get('/kartukeluarga', [KadusControllerMobile::class, 'getKartuKeluarga']);
        Route::get('/kartukeluarga/{no_kk}/anggota', [KadusControllerMobile::class, 'getAnggotaKeluarga']);
        Route::post('/pengajuan', [KadusControllerMobile::class, 'storePengajuan']); // Direct Disetujui Kepala Dusun
        Route::get('/suratmasuk', [KadusControllerMobile::class, 'suratmasuk']);
        Route::post('/suratmasuk/{id}/setuju', [KadusControllerMobile::class, 'setuju']);
        Route::post('/suratmasuk/{id}/tolak', [KadusControllerMobile::class, 'tolak']);
    });

    // =====================================================
    // 📜 ROLE 3: SEKRETARIS DESA (SEKDES)
    // =====================================================
    Route::prefix('sekdes')->group(function () {
        Route::get('/dashboard', [SekdesControllerMobile::class, 'dashboard']);
        Route::get('/suratmasuk', [SekdesControllerMobile::class, 'suratmasuk']);
        Route::post('/suratmasuk/{id}/setuju', [SekdesControllerMobile::class, 'setuju']);
        Route::post('/suratmasuk/{id}/tolak', [SekdesControllerMobile::class, 'tolak']);
        Route::get('/pengaduan', [SekdesControllerMobile::class, 'pengaduan']); // Read-only monitoring
    });

    // =====================================================
    // ✒️ ROLE 4: KEPALA DESA (KADES)
    // =====================================================
    Route::prefix('kades')->group(function () {
        Route::get('/dashboard', [KadesControllerMobile::class, 'dashboard']);
        Route::get('/suratmasuk', [KadesControllerMobile::class, 'suratmasuk']);
        Route::post('/suratmasuk/{id}/setuju', [KadesControllerMobile::class, 'setuju']); // Generate PDF & TTD -> Selesai
        Route::post('/suratmasuk/{id}/tolak', [KadesControllerMobile::class, 'tolak']);
        Route::get('/pengaduan', [KadesControllerMobile::class, 'pengaduan']); // Read-only monitoring
    });
});