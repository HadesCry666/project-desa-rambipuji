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
use App\Http\Controllers\API\SuratControllerMobile;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//biar aman
Route::middleware('api')->group(function(){
    Route::post('/register', [LoginControllerMobile::class, 'register']);
    Route::post('/login', [LoginControllerMobile::class, 'login']);
    Route::post('/forgot-password', [ForgotPasswordControllerMobile::class, 'sendResetLinkEmail']);
    Route::post('verify-otp', [ResetPasswordControllerMobile::class, 'verify'])->name('password.otp');
    Route::post('/reset-password', [ResetPasswordControllerMobile::class, 'reset'])->name('password.reset');

    Route::get('/surat', [SuratControllerMobile::class, 'index']);

    Route::get('/statusdiajukan', [StatusDiajukanControllerMobile::class, 'index']);
    Route::get('/statusditolak', [StatusDitolakControllerMobile::class, 'index']);
    Route::get('/statusselesai', [StatusSelesaiControllerMobile::class, 'index']);
    Route::delete('/suratdelete/{id}', [StatusDiajukanControllerMobile::class, 'destroy']);
    
    Route::get('/notifikasi', [NotifikasiControllerMobile::class, 'index']);
    Route::get('/notifikasi/{id}', [NotifikasiControllerMobile::class, 'show']);
    
    Route::get('/getprofil', [ProfileControllerMobile::class, 'index']);
    Route::post('/update-foto', [ProfileControllerMobile::class, 'updateFoto']);
    Route::post('/update-profil', [ProfileControllerMobile::class, 'updateEmailNoHp']);
    Route::get('/getdata', [ProfileControllerMobile::class, 'getByNik']);

    Route::post('/pengajuan', [PengajuanControllerMobile::class, 'store']);
    Route::post('/pengaduan', [PengaduanControllerMobile::class, 'store']);
   
    Route::get('/berita', [BeritaControllerMobile::class, 'index']);       // untuk daftar semua berita
    Route::get('/berita/{id}', [BeritaControllerMobile::class, 'show']);
});

Route::middleware('auth:sanctum')->post('/logout', [LoginControllerMobile::class, 'logout']);