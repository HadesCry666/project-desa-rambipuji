<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MasterKartuKeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('master_kartukeluargas')->insert([
            [
                'no_kk' => '3175091501230022',
                'alamat' => 'Jl. Melati No. 45',
                'rt' => '001',
                'rw' => '002',
                'desa' => 'Desa Wonorejo',
                'kecamatan' => 'Kecamatan Kedungjajang',
                'kode_pos' => 12345,
                'kabupaten' => 'Kabupaten Lumajang',
                'provinsi' => 'Jawa Timur',
                'tanggal_dibuat' => Carbon::now()->subYears(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kk' => '3175091501230032',
                'alamat' => 'Jl. Mawar No. 12',
                'rt' => '002',
                'rw' => '003',
                'desa' => 'Desa Wonorejo',
                'kecamatan' => 'Kecamatan Kedungjajang',
                'kode_pos' => 54321,
                'kabupaten' => 'Kabupaten Lumajang',
                'provinsi' => 'Jawa Timur',
                'tanggal_dibuat' => Carbon::now()->subMonths(6),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kk' => '3175091501230042',
                'alamat' => 'Jl. Anggrek No. 8',
                'rt' => '003',
                'rw' => '004',
                'desa' => 'Desa Wonorejo',
                'kecamatan' => 'Kecamatan Kedungjajang',
                'kode_pos' => 67890,
                'kabupaten' => 'Kabupaten Lumajang',
                'provinsi' => 'Jawa Timur',
                'tanggal_dibuat' => Carbon::now()->subMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kk' => '3175091501230052',
                'alamat' => 'Jl. Melati No. 45',
                'rt' => '001',
                'rw' => '002',
                'desa' => 'Desa Wonorejo',
                'kecamatan' => 'Kecamatan Kedungjajang',
                'kode_pos' => 12345,
                'kabupaten' => 'Kabupaten Lumajang',
                'provinsi' => 'Jawa Timur',
                'tanggal_dibuat' => Carbon::now()->subYears(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kk' => '3175091501230062',
                'alamat' => 'Jl. Mawar No. 12',
                'rt' => '002',
                'rw' => '003',
                'desa' => 'Desa Wonorejo',
                'kecamatan' => 'Kecamatan Kedungjajang',
                'kode_pos' => 54321,
                'kabupaten' => 'Kabupaten Lumajang',
                'provinsi' => 'Jawa Timur',
                'tanggal_dibuat' => Carbon::now()->subMonths(6),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kk' => '3175091501230072',
                'alamat' => 'Jl. Anggrek No. 8',
                'rt' => '003',
                'rw' => '004',
                'desa' => 'Desa Wonorejo',
                'kecamatan' => 'Kecamatan Kedungjajang',
                'kode_pos' => 67890,
                'kabupaten' => 'Kabupaten Lumajang',
                'provinsi' => 'Jawa Timur',
                'tanggal_dibuat' => Carbon::now()->subMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kk' => '3175091501230082',
                'alamat' => 'Jl. Melati No. 45',
                'rt' => '001',
                'rw' => '002',
                'desa' => 'Desa Wonorejo',
                'kecamatan' => 'Kecamatan Kedungjajang',
                'kode_pos' => 12345,
                'kabupaten' => 'Kabupaten Lumajang',
                'provinsi' => 'Jawa Timur',
                'tanggal_dibuat' => Carbon::now()->subYears(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kk' => '3175091501230092',
                'alamat' => 'Jl. Mawar No. 12',
                'rt' => '002',
                'rw' => '003',
                'desa' => 'Desa Wonorejo',
                'kecamatan' => 'Kecamatan Kedungjajang',
                'kode_pos' => 54321,
                'kabupaten' => 'Kabupaten Lumajang',
                'provinsi' => 'Jawa Timur',
                'tanggal_dibuat' => Carbon::now()->subMonths(6),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kk' => '3175091501230102',
                'alamat' => 'Jl. Anggrek No. 8',
                'rt' => '003',
                'rw' => '004',
                'desa' => 'Desa Wonorejo',
                'kecamatan' => 'Kecamatan Kedungjajang',
                'kode_pos' => 67890,
                'kabupaten' => 'Kabupaten Lumajang',
                'provinsi' => 'Jawa Timur',
                'tanggal_dibuat' => Carbon::now()->subMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kk' => '3175091501230112',
                'alamat' => 'Jl. Melati No. 45',
                'rt' => '001',
                'rw' => '002',
                'desa' => 'Desa Wonorejo',
                'kecamatan' => 'Kecamatan Kedungjajang',
                'kode_pos' => 12345,
                'kabupaten' => 'Kabupaten Lumajang',
                'provinsi' => 'Jawa Timur',
                'tanggal_dibuat' => Carbon::now()->subYears(1),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

}
