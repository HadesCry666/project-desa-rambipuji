<?php

use Illuminate\Support\Facades\Route;

// ADMIN
use App\Http\Controllers\Admin\AkunRtController;
use App\Http\Controllers\Admin\AkunRwController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GeneratePDFController;
use App\Http\Controllers\Admin\KartuKeluargaController;
use App\Http\Controllers\Admin\LandingpageController;
use App\Http\Controllers\Admin\PendudukController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\SuratController;
use App\Http\Controllers\Admin\SuratDitolakController;
use App\Http\Controllers\Admin\SuratMasukController;
use App\Http\Controllers\Admin\SuratSelesaiController;
use App\Http\Controllers\Admin\TambahPengajuanController;

// RW
use App\Http\Controllers\RW\DashboardRWController;
use App\Http\Controllers\RW\SuratMasukRWController;
use App\Http\Controllers\RW\SuratSelesaiRWController;

// RT
use App\Http\Controllers\RT\DashboardRTController;
use App\Http\Controllers\RT\SuratMasukRTController;
use App\Http\Controllers\RT\SuratDitolakRTController;
use App\Http\Controllers\RT\SuratSelesaiRTController;

// SEKDES, KADES, KADUS
use App\Http\Controllers\SekretarisDesa\SekdesDashboardController;
use App\Http\Controllers\SekretarisDesa\SekdesKartuKeluargaController;
use App\Http\Controllers\SekretarisDesa\SekdesPendudukController;
use App\Http\Controllers\SekretarisDesa\SekdesSuratMasukController;
use App\Http\Controllers\SekretarisDesa\SekdesSuratSelesaiController;
use App\Http\Controllers\SekretarisDesa\SekdesSuratDitolakController;
use App\Http\Controllers\SekretarisDesa\SekdesPengaduanController;

use App\Http\Controllers\KepalaDesa\KadesDashboardController;
use App\Http\Controllers\KepalaDesa\KadesKartuKeluargaController;
use App\Http\Controllers\KepalaDesa\KadesPendudukController;
use App\Http\Controllers\KepalaDesa\KadesSuratMasukController;
use App\Http\Controllers\KepalaDesa\KadesSuratSelesaiController;
use App\Http\Controllers\KepalaDesa\KadesPengaduanController;

use App\Http\Controllers\KepalaDusun\KadusDashboardController;
use App\Http\Controllers\KepalaDusun\KadusSuratMasukController;
use App\Http\Controllers\KepalaDusun\KadusTambahPengajuanController;

// USER
use App\Http\Controllers\LoginController;

// DASHBOARD
Route::get('/', [LandingpageController::class, 'tampil'])->name('website');

Route::get('/check-nama-nik', function () {
    return view('cekk');
})->middleware('auth');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.proses')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// RT
Route::middleware(['auth', 'role:3'])->prefix('rt')->group(function () {

    Route::get('/dashboard-rt', [DashboardRTController::class, 'index'])->name('dashboard.rt');

    // SURAT MASUK
    Route::get('/suratmasuk-rt', [SuratMasukRTController::class, 'index'])->name('rt.suratmasuk.index');
    Route::post('/suratmasuk-rt/setujui/{id_pengajuan}', [SuratMasukRTController::class, 'setujui'])->name('rt.suratmasuk.setuju');
    Route::post('/suratmasuk-rt/tolak/{id_pengajuan}', [SuratMasukRTController::class, 'tolak'])->name('rt.suratmasuk.tolak');

    // SURAT SELESAI
    Route::get('/suratselesai-rt', [SuratSelesaiRTController::class, 'index'])->name('rt.suratselesai.index');
    Route::get('/suratselesai-rt/{id}', [SuratSelesaiRTController::class, 'show'])->name('rt.suratselesai.show');
    Route::delete('/suratselesai-rt/{id}', [SuratSelesaiRTController::class, 'destroy'])->name('rt.suratselesai.destroy');

    // SURAT DITOLAK
    Route::get('/suratditolak-rt', [SuratDitolakRTController::class, 'index'])->name('rt.suratditolak.index');
    Route::get('/suratditolak-rt/{id}', [SuratDitolakRTController::class, 'show'])->name('rt.suratditolak.show');
    Route::post('/suratditolak-rt/alasan', [SuratDitolakRTController::class, 'alasanPenolakan'])->name('rt.suratditolak.alasan');
    Route::delete('/suratditolak-rt/{id}', [SuratDitolakRTController::class, 'destroy'])->name('rt.suratditolak.destroy');

});


// RW
Route::middleware(['auth', 'role:2'])->prefix('rw')->group(function () {

    Route::get('/dashboard-rw', [DashboardRWController::class, 'index'])->name('rw.dashboard');

    // SURAT MASUK
    Route::get('/suratmasuk-rw', [SuratMasukRWController::class, 'index'])->name('rw.suratmasuk.index');
    Route::get('/suratmasuk-rw/{id_pengajuan}', [SuratMasukRWController::class, 'show'])->name('rw.suratmasuk.show');
    Route::post('/suratmasuk-rw/setujui/{id_pengajuan}', [SuratMasukRWController::class, 'setujui'])->name('rw.suratmasuk.setujui');
    Route::delete('/suratmasuk-rw/{id_pengajuan}', [SuratMasukRWController::class, 'destroy'])->name('rw.suratmasuk.destroy');

    // SURAT SELESAI
    Route::get('/suratselesai-rw', [SuratSelesaiRWController::class, 'index'])->name('rw.suratselesai.index');
    Route::get('/suratselesai-rw/{id_pengajuan}', [SuratSelesaiRWController::class, 'show'])->name('rw.suratselesai.show');
    Route::delete('/suratselesai-rw/{id}', [SuratSelesaiRWController::class, 'destroy'])->name('rw.suratselesai.destroy');
});


// ADMIN
Route::middleware(['auth', 'role:1'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // KARTU KELUARGA
    Route::get('master_kartukeluarga', [KartuKeluargaController::class, 'index'])->name('kartukeluarga.view');
    Route::post('master_kartukeluarga/masuk', [KartuKeluargaController::class, 'masuk'])->name('kartukeluarga.masuk');
    Route::put('master_kartukeluarga/{no_kk}', [KartuKeluargaController::class, 'update'])->name('kartukeluarga.update');
    Route::delete('master_kartukeluarga/{no_kk}', [KartuKeluargaController::class, 'delete'])->name('kartukeluarga.delete');
    Route::get('get-data-kk/{no_kk}', [KartuKeluargaController::class, 'getDataKK']);

    // MASTER PENDUDUK
    Route::get('master_penduduk', [PendudukController::class, 'index']);
    Route::post('master_penduduk/masuk', [PendudukController::class, 'masuk']);
    Route::put('master_penduduk/{nik}', [PendudukController::class, 'update']);
    Route::delete('master_penduduk/{nik}', [PendudukController::class, 'delete'])->name('penduduk.delete');


    // MASTER AKUN RW
    Route::get('akunrw/create', [AkunRwController::class, 'create']);
    Route::get('/akunrw', [AkunRwController::class, 'index'])->name('akunrw');
    Route::post('akunrw/store', [AkunRwController::class, 'store'])->name('akunrw.store');
    Route::put('akunrw/update/{id}', [AkunRwController::class, 'update'])->name('akunrw.update');
    Route::delete('akunrw/{id}', [AkunRwController::class, 'destroy'])->name('akunrw.delete');
    Route::get('get-nama-rw', [AkunRwController::class, 'getNamaRw']);

    // MASTER AKUN RT
    Route::get('akunrt/create', [AkunRtController::class, 'create']);
    Route::get('/akunrt', [AkunRtController::class, 'index'])->name('akunrt');
    Route::post('akunrt/store', [AkunRtController::class, 'store'])->name('akunrt.store');
    Route::put('akunrt/update/{id}', [AkunRtController::class, 'update'])->name('akunrt.update');
    Route::delete('akunrt/{id_rtrw}', [AkunRtController::class, 'destroy'])->name('akunrt.delete');
    Route::get('get-nama-by-nik', [AkunRtController::class, 'getNamaByNik']);

    // LANDINGPAGE
    Route::get('/landingpage', [LandingpageController::class, 'index'])->name('homepage.index');
    Route::post('/landingpage', [LandingpageController::class, 'update'])->name('homepage.update');

    // SURAT MASUK
    Route::get('/suratmasuk', [SuratMasukController::class, 'index'])->name('pengajuan.masuk');
    Route::post('/suratmasuk/{id_pengajuan}/setuju', [SuratMasukController::class, 'setuju'])->name('pengajuan.setuju');
    Route::post('/suratmasuk/{id_pengajuan}/tolak', [SuratMasukController::class, 'tolak'])->name('pengajuan.tolak');
    Route::delete('/suratmasuk/{id_pengajuan}/delete', [SuratMasukController::class, 'destroy'])->name('pengajuan.hapus');
    Route::get('/suratmasuk/{id_pengajuan}/cetak', [GeneratePDFController::class, 'generateAndStorePdf']);

    // TAMBAH PENGAJUAN SURAT (oleh Admin)
    Route::get('/tambah-pengajuan', [TambahPengajuanController::class, 'index'])->name('pengajuan.tambah.index');
    Route::post('/tambah-pengajuan', [TambahPengajuanController::class, 'store'])->name('pengajuan.tambah.store');

    // SURAT DITOLAK
    Route::get('/suratditolak', [SuratditolakController::class, 'index'])->name('suratditolak.tampil');
    Route::delete('/suratditolak/{id_pengajuan}/delete', [SuratditolakController::class, 'destroy'])->name('suratditolak.hapus');

    // SURAT SELESAI
    Route::get('/suratselesai', [SuratSelesaiController::class, 'index'])->name('suratselesai.index');

    // MASTER SURAT
    Route::get('/mastersurat', [SuratController::class, 'index'])->name('mastersurat.index');
    Route::post('/mastersurat/masuk', [SuratController::class, 'store'])->name('mastersurat.store');
    Route::put('/mastersurat/update/{id}', [SuratController::class, 'update'])->name('mastersurat.update');
    Route::delete('/mastersurat/delete/{id}', [SuratController::class, 'destroy'])->name('mastersurat.destroy');
    Route::get('suratmasuk/{id}/cetak', [GeneratePDFController::class, 'generateAndStorePdf']);

    // MASTER PENGADUAN
    Route::get('pengaduan', [PengaduanController::class, 'index'])->name('master-pengaduan.index');
    Route::get('pengaduan/create', [PengaduanController::class, 'create'])->name('master-pengaduan.create');
    Route::post('pengaduan', [PengaduanController::class, 'store'])->name('master-pengaduan.store');
    Route::get('pengaduan/{id}', [PengaduanController::class, 'show'])->name('master-pengaduan.show');
    Route::delete('pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('master-pengaduan.destroy');
    Route::post('/pengaduan/{id}/feedback', [PengaduanController::class, 'feedback'])->name('pengaduan.feedback');
});

// SEKRETARIS DESA
Route::middleware(['auth', 'role:4'])->prefix('sekretarisdesa')->group(function () {

    // Dashboard
    Route::get('/dashboard', [SekdesDashboardController::class, 'index'])->name('sekdes.dashboard');

    // Surat Masuk
    Route::get('/suratmasuk', [SekdesSuratMasukController::class, 'index'])->name('sekdes.suratmasuk.index');
    Route::post('/suratmasuk/{id}/setuju', [SekdesSuratMasukController::class, 'setuju'])->name('sekdes.suratmasuk.setuju');
    Route::post('/suratmasuk/{id}/tolak', [SekdesSuratMasukController::class, 'tolak'])->name('sekdes.suratmasuk.tolak');

    // Surat Selesai
    Route::get('/suratselesai', [SekdesSuratSelesaiController::class, 'index'])->name('sekdes.suratselesai.index');

    // Master Pengaduan — Read-Only (Sekdes hanya bisa melihat, tidak bisa membalas/menghapus)
    Route::get('/pengaduan', [SekdesPengaduanController::class, 'index'])->name('sekdes.pengaduan.index');

    // Master Kartu Keluarga
    Route::get('/kartukeluarga', [SekdesKartuKeluargaController::class, 'index'])->name('sekdes.kartukeluarga.index');
    Route::delete('/kartukeluarga/{no_kk}', [SekdesKartuKeluargaController::class, 'delete'])->name('sekdes.kartukeluarga.delete');

    // Master Penduduk
    Route::get('/penduduk', [SekdesPendudukController::class, 'index'])->name('sekdes.penduduk.index');
    Route::post('/penduduk/masuk', [SekdesPendudukController::class, 'masuk'])->name('sekdes.penduduk.masuk');
    Route::put('/penduduk/{nik}', [SekdesPendudukController::class, 'update'])->name('sekdes.penduduk.update');
    Route::delete('/penduduk/{nik}', [SekdesPendudukController::class, 'delete'])->name('sekdes.penduduk.delete');

    // Surat Ditolak
    Route::get('/suratditolak', [SekdesSuratDitolakController::class, 'index'])->name('sekdes.suratditolak.index');

});

// KEPALA DESA
Route::middleware(['auth', 'role:5'])->prefix('kepaladesa')->group(function () {

    // Dashboard
    Route::get('/dashboard', [KadesDashboardController::class, 'index'])->name('kades.dashboard');

    // Surat Masuk
    Route::get('/suratmasuk', [KadesSuratMasukController::class, 'index'])->name('kades.suratmasuk.index');
    Route::post('/suratmasuk/{id}/setuju', [KadesSuratMasukController::class, 'setuju'])->name('kades.suratmasuk.setuju');
    Route::post('/suratmasuk/{id}/tolak', [KadesSuratMasukController::class, 'tolak'])->name('kades.suratmasuk.tolak');

    // Surat Selesai
    Route::get('/suratselesai', [KadesSuratSelesaiController::class, 'index'])->name('kades.suratselesai.index');

    // Master Pengaduan — Read-Only (Kades hanya bisa melihat)
    Route::get('/pengaduan', [KadesPengaduanController::class, 'index'])->name('kades.pengaduan.index');

    // Master Kartu Keluarga
    Route::get('/kartukeluarga', [KadesKartuKeluargaController::class, 'index'])->name('kades.kartukeluarga.index');

    // Master Penduduk
    Route::get('/penduduk', [KadesPendudukController::class, 'index'])->name('kades.penduduk.index');

});

// KEPALA DUSUN
Route::middleware(['auth', 'role:2'])->prefix('kepaladusun')->group(function () {

    // Dashboard
    Route::get('/dashboard', [KadusDashboardController::class, 'index'])->name('kadus.dashboard');

    // Surat Masuk (Diajukan)
    Route::get('/suratmasuk', [KadusSuratMasukController::class, 'index'])->name('kadus.suratmasuk.index');
    Route::post('/suratmasuk/{id}/setuju', [KadusSuratMasukController::class, 'setuju'])->name('kadus.suratmasuk.setuju');
    Route::post('/suratmasuk/{id}/tolak', [KadusSuratMasukController::class, 'tolak'])->name('kadus.suratmasuk.tolak');

    // Tambah Pengajuan oleh Kepala Dusun atas nama Warga
    Route::get('/tambah-pengajuan', [KadusTambahPengajuanController::class, 'index'])->name('kadus.tambahpengajuan.index');
    Route::post('/tambah-pengajuan', [KadusTambahPengajuanController::class, 'store'])->name('kadus.tambahpengajuan.store');
    Route::get('/get-kk-list', [KadusTambahPengajuanController::class, 'getKKList'])->name('kadus.get.kk.list');
    Route::get('/get-anggota-kk/{no_kk}', [KadusTambahPengajuanController::class, 'getAnggotaKK'])->name('kadus.get.anggota.kk');
    Route::get('/get-penduduk-by-nik', [KadusTambahPengajuanController::class, 'getPendudukByNik'])->name('kadus.get.penduduk.nik');

    // Surat Selesai
    Route::get('/suratselesai', [KadusSuratMasukController::class, 'suratselesai'])->name('kadus.suratselesai.index');

    // Surat Ditolak
    Route::get('/suratditolak', [KadusSuratMasukController::class, 'suratditolak'])->name('kadus.suratditolak.index');

});