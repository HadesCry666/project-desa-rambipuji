<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('master_pengajuan', 'keterangan_admin')) {
            Schema::table('master_pengajuan', function (Blueprint $table) {
                $table->text('keterangan_admin')->nullable()->after('keterangan_ditolak');
            });
        }

        // Re-create DB view view_data_pengajuan with keterangan_admin
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('master_pengajuan', 'keterangan_admin')) {
            Schema::table('master_pengajuan', function (Blueprint $table) {
                $table->dropColumn('keterangan_admin');
            });
        }
    }
};
