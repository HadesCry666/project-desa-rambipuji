<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterPengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('master_pengaduan')->insert([
            [
                'nik' => '3508164505800002', // Ajiee
                'ulasan' => 'Lampu jalan di area RT 01 mati sudah 3 hari, mohon segera diperbaiki karena gelap saat malam.',
                'foto1' => 'lampu_mati.jpg',
                'feedback' => 'Terima kasih laporannya, petugas akan mengecek lokasi besok pagi.',
                'kategori' => 'Fasilitas Umum',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nik' => '3508161212950001', // Budi Santoso
                'ulasan' => 'Sampah di TPS pasar mulai menumpuk dan menimbulkan bau tidak sedap. Sangat mengganggu warga.',
                'foto1' => 'tumpukan_sampah.png',
                'feedback' => 'Akan segera dikoordinasikan dengan dinas kebersihan.',
                'kategori' => 'Kebersihan',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nik' => '3508161212950001', // Agus Setiawan
                'ulasan' => 'Jalanan di depan balai desa berlubang cukup dalam, membahayakan pengendara motor.',
                'foto1' => 'jalan_rusak.jpg',
                'feedback' => 'Laporan diterima, perbaikan jalan masuk agenda bulan depan.',
                'kategori' => 'Infrastruktur',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nik' => '3508161212950001', // Hendra Pratama
                'ulasan' => 'Mohon bantuan untuk pengasapan (fogging) karena banyak nyamuk di lingkungan kami.',
                'foto1' => 'fogging.jpg',
                'feedback' => 'Jadwal fogging wilayah Anda hari Jumat ini.',
                'kategori' => 'Kesehatan',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nik' => '3508160505750001', // Mulyono
                'ulasan' => 'Aliran air bersih di Dusun Krajan mati sejak tadi pagi, mohon bantuannya.',
                'foto1' => 'air_mati.jpg',
                'feedback' => 'Sedang ada perbaikan pipa utama, mohon menunggu.',
                'kategori' => 'Fasilitas Umum',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nik' => '3508161212950001', // Fajar Ramadhan
                'ulasan' => 'Pelayanan di kantor desa sangat lambat, saya menunggu 2 jam hanya untuk tanda tangan.',
                'foto1' => 'pelayanan.jpg',
                'feedback' => 'Mohon maaf atas ketidaknyamanannya, akan kami evaluasi.',
                'kategori' => 'Pelayanan',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nik' => '3508164505800002', // Ajiee
                'ulasan' => 'Drainase tersumbat di bawah jembatan, air meluap ke jalan saat hujan deras.',
                'foto1' => 'banjir.jpg',
                'feedback' => null,
                'kategori' => 'Infrastruktur',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nik' => '3508164505800002', // Budi Santoso
                'ulasan' => 'Banyak hewan ternak liar berkeliaran di taman desa dan merusak tanaman hias.',
                'foto1' => 'ternak.jpg',
                'feedback' => 'Akan ditegur pemiliknya.',
                'kategori' => 'Ketertiban',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nik' => '3508161212950001', // Agus Setiawan
                'ulasan' => 'Internet gratis di balai desa tidak bisa tersambung, tolong dicek routernya.',
                'foto1' => 'wifi_error.jpg',
                'feedback' => 'Router sedang restart otomatis.',
                'kategori' => 'Fasilitas Umum',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nik' => '3508161212980002', // Hendra Pratama
                'ulasan' => 'Suara bising dari proyek pembangunan sampai malam hari sangat mengganggu waktu istirahat.',
                'foto1' => 'bising.jpg',
                'feedback' => null,
                'kategori' => 'Ketertiban',
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);
    }
}
