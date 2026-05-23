<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS trg_feedback_pengaduan_update");

        DB::unprepared("
            CREATE TRIGGER trg_feedback_pengaduan_update
            AFTER UPDATE ON master_pengaduan
            FOR EACH ROW
            BEGIN
                IF 
                    NEW.feedback IS NOT NULL AND 
                    NEW.feedback != '' AND 
                    (OLD.feedback IS NULL OR NEW.feedback != OLD.feedback) 
                THEN

                    INSERT INTO notifikasi_pengajuan (
                        nik,
                        jenis,
                        id_ref,
                        pesan,
                        created_at
                    ) 
                    VALUES (
                        NEW.nik,
                        'pengaduan',
                        NEW.id,
                        'Pengaduan anda telah diproses oleh pihak desa',
                        NOW()
                    );

                END IF;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS trg_feedback_pengaduan_update");
    }
};