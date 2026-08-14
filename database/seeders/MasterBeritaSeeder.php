<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterBeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan NIK di bawah ini sudah terdaftar di tabel master_akuns
        // Biasanya admin memiliki NIK tertentu yang sudah kamu set di MasterAkunSeeder

        DB::table('master_beritas')->insert([
            [
                'id_berita' => 1,
                'judul' => 'Pengumuman Jadwal Pelayanan Desa Ramadhan 2026',
                'deskripsi' => 'Selama bulan suci Ramadhan, pelayanan administrasi di balai desa dimulai pukul 08.00 hingga 14.00 WIB.',
                'nik' => '3508164711850002', // Contoh NIK Admin
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_berita' => 2,
                'judul' => 'Peringatan Dini Cuaca Ekstrem Wilayah Jember',
                'deskripsi' => 'Dihimbau kepada seluruh warga untuk waspada terhadap potensi hujan lebat disertai angin kencang dalam tiga hari ke depan.',
                'nik' => '3508164711850002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   'id_berita' => 3,
                'judul' => 'Peresmian Taman Digital Desa',
                'deskripsi' => 'Fasilitas internet gratis kini sudah tersedia di area taman desa untuk mendukung pembelajaran daring warga.',
                'nik' => '3508164711850002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_berita' => 4,
                'judul' => 'Laporan Transparansi Dana Desa Tahap I',
                'deskripsi' => 'Rincian penggunaan dana desa tahap I tahun anggaran 2026 telah ditempel di papan pengumuman balai desa.',
                'nik' => '3508164711850002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_berita' => 5,
                'judul' => 'Pelatihan UMKM Kerajinan Tangan',
                'deskripsi' => 'Daftarkan segera kelompok UMKM Anda untuk mengikuti pelatihan ekspor produk kerajinan tangan bulan depan.',
                'nik' => '3508164711850002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
