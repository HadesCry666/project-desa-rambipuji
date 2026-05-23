<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS trg_status_pengajuan_update_with_join");

        DB::unprepared("
            CREATE TRIGGER trg_status_pengajuan_update_with_join
            AFTER UPDATE ON master_pengajuan
            FOR EACH ROW
            BEGIN
                DECLARE pesan_notifikasi TEXT;
                DECLARE nama_surat VARCHAR(255);
                DECLARE nama_pemohon VARCHAR(255);

                IF NEW.status != OLD.status AND NEW.status != 'diajukan' THEN

                    SELECT 
                        ms.nama_surat,
                        p.nama_lengkap
                    INTO 
                        nama_surat,
                        nama_pemohon
                    FROM master_surat ms
                    JOIN master_penduduks p ON p.nik = NEW.nik
                    WHERE ms.id_surat = NEW.id_surat
                    LIMIT 1;

                    IF NEW.status = 'Disetujui RT' THEN
                        SET pesan_notifikasi = CONCAT(
                            'Halo ', nama_pemohon,
                            ', pengajuan ', nama_surat,
                            ' Anda telah disetujui pihak RT'
                        );

                    ELSEIF NEW.status = 'Disetujui RW' THEN
                        SET pesan_notifikasi = CONCAT(
                            'Halo ', nama_pemohon,
                            ', pengajuan ', nama_surat,
                            ' Anda telah disetujui pihak RW'
                        );

                    ELSEIF NEW.status = 'Selesai' THEN
                        SET pesan_notifikasi = CONCAT(
                            'Halo ', nama_pemohon,
                            ', ', nama_surat,
                            ' telah selesai. Silakan unduh dokumen Anda'
                        );

                    ELSEIF NEW.status = 'Ditolak' THEN
                        SET pesan_notifikasi = CONCAT(
                            'Halo ', nama_pemohon,
                            ', pengajuan ', nama_surat,
                            ' Anda ditolak. Silakan periksa keterangan penolakan'
                        );
                    END IF;

                    IF pesan_notifikasi IS NOT NULL THEN

                        DELETE FROM notifikasi_pengajuan
                        WHERE nik = NEW.nik
                          AND id_ref = NEW.id_pengajuan
                          AND jenis = 'pengajuan';

                        INSERT INTO notifikasi_pengajuan (
                            nik,
                            jenis,
                            id_ref,
                            pesan,
                            created_at
                        )
                        VALUES (
                            NEW.nik,
                            'pengajuan',
                            NEW.id_pengajuan,
                            pesan_notifikasi,
                            NOW()
                        );

                    END IF;

                END IF;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS trg_status_pengajuan_update_with_join");
    }
};