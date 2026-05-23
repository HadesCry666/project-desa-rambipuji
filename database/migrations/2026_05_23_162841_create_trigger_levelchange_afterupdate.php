<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS levelchange_afterupdate");

        DB::unprepared("
            CREATE TRIGGER levelchange_afterupdate
            AFTER UPDATE ON master_rt_rw
            FOR EACH ROW
            BEGIN
                IF NEW.rt IS NOT NULL THEN
                    UPDATE master_akun
                    SET level = 3
                    WHERE nik = NEW.nik;
                ELSE
                    UPDATE master_akun
                    SET level = 2
                    WHERE nik = NEW.nik;
                END IF;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS levelchange_afterupdate");
    }
};