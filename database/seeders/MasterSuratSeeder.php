<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterSuratSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('master_surat')->insert([
            [
                'id_surat' => '1',
                'nama_surat' => 'Surat Keterangan Usaha (SKU)',
                'slug' => 'surat-keterangan-usaha',
                'keterangan' => 'Surat Keterangan Usaha',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_surat' => '2',
                'nama_surat' => 'Surat Keterangan Tidak Mampu (SKTM)',
                'slug' => 'surat-keterangan-tidak-mampu',
                'keterangan' => 'Surat Keterangan Tidak Mampu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_surat' => '3',
                'nama_surat' => 'Surat Keterangan Domisili',
                'slug' => 'surat-keterangan-domisili',
                'keterangan' => 'Surat Keterangan Domisili',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_surat' => '4',
                'nama_surat' => 'Surat Pengantar SKCK',
                'slug' => 'surat-pengantar-skck',
                'keterangan' => 'Surat Pengantar SKCK',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_surat' => '5',
                'nama_surat' => 'Surat Keterangan Kematian',
                'slug' => 'surat-keterangan-kematian',
                'keterangan' => 'Surat Keterangan Kematian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
