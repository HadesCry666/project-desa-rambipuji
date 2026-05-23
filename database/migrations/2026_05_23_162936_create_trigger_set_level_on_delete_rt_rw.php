<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS set_level_on_delete_or_update_rt_rw");

        DB::unprepared("
            CREATE TRIGGER set_level_on_delete_or_update_rt_rw
            AFTER DELETE ON master_rt_rw
            FOR EACH ROW
            BEGIN
                UPDATE master_akun
                SET level = 4
                WHERE nik = OLD.nik;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS set_level_on_delete_or_update_rt_rw");
    }
};