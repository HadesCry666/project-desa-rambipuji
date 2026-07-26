<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MasterUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('master_akun')->truncate();

        DB::table('master_akun')->insert([
            // 1. Akun Admin Desa
            [
                'id' => 1,
                'nik' => '3508161503900001', // Agus Setiawan (Ada di MasterPendudukSeeder)
                'no_hp' => '081234567890',
                'email' => 'admin@desa.id',
                'foto_profil' => 'default.png',
                'level' => 1,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 2. Akun Kepala Dusun
            [
                'id' => 2,
                'nik' => '3508160711800001', // Budi Santoso (Ada di MasterPendudukSeeder)
                'no_hp' => '082345678901',
                'email' => 'kadus@desa.id',
                'foto_profil' => 'default.png',
                'level' => 2,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 3. Akun Sekretaris Desa
            [
                'id' => 3,
                'nik' => '3508162002880001', // Hendra Pratama (Ada di MasterPendudukSeeder)
                'no_hp' => '083456789012',
                'email' => 'sekdes@desa.id',
                'foto_profil' => 'default.png',
                'level' => 3,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 4. Akun Kepala Desa
            [
                'id' => 4,
                'nik' => '3508160505750001', // Mulyono (Ada di MasterPendudukSeeder)
                'no_hp' => '084567890123',
                'email' => 'kades@desa.id',
                'foto_profil' => 'default.png',
                'level' => 4,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
