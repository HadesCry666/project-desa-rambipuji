<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Tambah kolom nomor_surat_keluar ke tabel master_pengajuan.
     * Format nomor: 511/{urutan}/{kode_desa}/{tahun}
     * Contoh: 511/135/35.09.13.2006/2026
     */
    public function up(): void
    {
        // 1. Tambah kolom nomor_surat_keluar
        if (!Schema::hasColumn('master_pengajuan', 'nomor_surat_keluar')) {
            Schema::table('master_pengajuan', function (Blueprint $table) {
                $table->string('nomor_surat_keluar', 50)->nullable()->after('no_registrasi');
            });
        }

        // 2. Refresh VIEW agar menyertakan kolom nomor_surat_keluar
        DB::statement("
            CREATE OR REPLACE VIEW view_data_pengajuan AS
                SELECT 
                    p.nik AS nik,
                    p.nama_lengkap AS nama_lengkap,
                    p.jenis_kelamin AS jenis_kelamin,

                    CONCAT(p.tempat_lahir, ', ', DATE_FORMAT(p.tanggal_lahir, '%d/%m/%Y')) AS tempat_tanggal_lahir,
                    CONCAT(p.kewarganegaraan, ' / ', p.agama) AS warga_agama,

                    p.pendidikan AS pendidikan,
                    p.pekerjaan AS pekerjaan,
                    p.status_perkawinan AS status_perkawinan,

                    k.alamat AS alamat,
                    k.rt AS rt,
                    k.rw AS rw,

                    pg.id_pengajuan AS id_pengajuan,
                    pg.id_surat AS id_surat,
                    s.nama_surat AS nama_surat,
                    pg.no_registrasi AS no_registrasi,
                    pg.nomor_surat_keluar AS nomor_surat_keluar,
                    pg.keperluan AS keperluan,
                    DATE_FORMAT(pg.tanggal_diajukan, '%d/%m/%Y') AS tanggal_diajukan,
                    pg.status AS status,
                    pg.keterangan_ditolak AS keterangan_ditolak,
                    pg.keterangan_admin AS keterangan_admin,

                    pg.foto1 AS foto1,
                    pg.foto2 AS foto2,
                    pg.foto3 AS foto3,
                    pg.foto4 AS foto4,
                    pg.foto5 AS foto5,
                    pg.foto6 AS foto6,
                    pg.foto7 AS foto7,
                    pg.foto8 AS foto8,
                    DATE(pg.created_at) AS created_at,
                    DATE(pg.updated_at) AS updated_at

                FROM 
                    master_penduduks p
                JOIN 
                    master_kartukeluargas k ON p.no_kk = k.no_kk
                JOIN 
                    master_pengajuan pg ON p.nik = pg.nik
                JOIN 
                    master_surat s ON pg.id_surat = s.id_surat;
        ");
    }

    public function down(): void
    {
        // Kembalikan VIEW tanpa kolom nomor_surat_keluar
        DB::statement("
            CREATE OR REPLACE VIEW view_data_pengajuan AS
                SELECT 
                    p.nik AS nik,
                    p.nama_lengkap AS nama_lengkap,
                    p.jenis_kelamin AS jenis_kelamin,
                    CONCAT(p.tempat_lahir, ', ', DATE_FORMAT(p.tanggal_lahir, '%d/%m/%Y')) AS tempat_tanggal_lahir,
                    CONCAT(p.kewarganegaraan, ' / ', p.agama) AS warga_agama,
                    p.pendidikan AS pendidikan,
                    p.pekerjaan AS pekerjaan,
                    p.status_perkawinan AS status_perkawinan,
                    k.alamat AS alamat,
                    k.rt AS rt,
                    k.rw AS rw,
                    pg.id_pengajuan AS id_pengajuan,
                    pg.id_surat AS id_surat,
                    s.nama_surat AS nama_surat,
                    pg.no_registrasi AS no_registrasi,
                    pg.keperluan AS keperluan,
                    DATE_FORMAT(pg.tanggal_diajukan, '%d/%m/%Y') AS tanggal_diajukan,
                    pg.status AS status,
                    pg.keterangan_ditolak AS keterangan_ditolak,
                    pg.foto1 AS foto1,
                    pg.foto2 AS foto2,
                    pg.foto3 AS foto3,
                    pg.foto4 AS foto4,
                    pg.foto5 AS foto5,
                    pg.foto6 AS foto6,
                    pg.foto7 AS foto7,
                    pg.foto8 AS foto8,
                    DATE(pg.created_at) AS created_at,
                    DATE(pg.updated_at) AS updated_at
                FROM 
                    semester6.master_penduduks p
                JOIN 
                    semester6.master_kartukeluargas k ON p.no_kk = k.no_kk
                JOIN 
                    semester6.master_pengajuan pg ON p.nik = pg.nik
                JOIN 
                    semester6.master_surat s ON pg.id_surat = s.id_surat;
        ");

        if (Schema::hasColumn('master_pengajuan', 'nomor_surat_keluar')) {
            Schema::table('master_pengajuan', function (Blueprint $table) {
                $table->dropColumn('nomor_surat_keluar');
            });
        }
    }
};
