<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
{
    DB::unprepared("DROP TRIGGER IF EXISTS add_data_level_rtrw_insert");

    DB::unprepared(<<<'SQL'
        CREATE TRIGGER add_data_level_rtrw_insert
        AFTER INSERT ON master_rt_rw
        FOR EACH ROW
        BEGIN
            IF EXISTS (SELECT 1 FROM master_akun WHERE nik = NEW.nik) THEN

                IF NEW.rt IS NOT NULL THEN
                    UPDATE master_akun 
                    SET level = 3 
                    WHERE nik = NEW.nik;
                ELSE
                    UPDATE master_akun 
                    SET level = 2 
                    WHERE nik = NEW.nik;
                END IF;

            ELSE

                INSERT INTO master_akun (
                    nik,
                    no_hp,
                    email,
                    level,
                    password,
                    created_at
                )
                VALUES (
                    NEW.nik,
                    NEW.no_hp,
                    CONCAT(NEW.nik, '@example.com'),
                    IF(NEW.rt IS NOT NULL, 3, 2),
                    '$2y$10$OFx9Rww1JcjtzO8FaILh1.YS9FzASSfdmPkIe0p2gkrFxBHHomKOC',
                    NOW()
                );

            END IF;
        END
    SQL);
}

    public function down(): void
{
    DB::unprepared("DROP TRIGGER IF EXISTS add_data_level_rtrw_insert");
}
};