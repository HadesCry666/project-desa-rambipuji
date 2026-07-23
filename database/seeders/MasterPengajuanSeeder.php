<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterPengajuanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('master_pengajuan')->insert([
            [
                'id_surat' => 1,
                'nik' => '3508160505750001', // Mulyono
                'keperluan' => 'Permohonan Pinjaman Kredit Usaha Mikro BRI',
                'tanggal_diajukan' => now()->subDays(1),
                'status' => 'Disetujui RW',
                'keterangan_ditolak' => null,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'id_surat' => 2,
                'nik' => '3508160711800001', // Budi Santoso
                'keperluan' => 'Pengurusan Beasiswa Pendidikan Anak',
                'tanggal_diajukan' => now()->subDays(2),
                'status' => 'Disetujui Sekdes',
                'keterangan_ditolak' => null,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'id_surat' => 3,
                'nik' => '3508161212950001', // Fajar Ramadhan
                'keperluan' => 'Kelengkapan Berkas Lamaran Kerja BUMN',
                'tanggal_diajukan' => now()->subDays(3),
                'status' => 'Disetujui RW',
                'keterangan_ditolak' => null,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'id_surat' => 4,
                'nik' => '3508161212980002', // Adit Pratama
                'keperluan' => 'Pendaftaran CPNS Tahun 2026',
                'tanggal_diajukan' => now()->subDays(5),
                'status' => 'Selesai',
                'keterangan_ditolak' => null,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'id_surat' => 1,
                'nik' => '3508160711800001', // Budi Santoso
                'keperluan' => 'Pembukaan Cabang Toko Sembako',
                'tanggal_diajukan' => now()->subDays(6),
                'status' => 'Selesai',
                'keterangan_ditolak' => null,
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],
            [
                'id_surat' => 2,
                'nik' => '3508160505750001', // Mulyono
                'keperluan' => 'Keringanan Biaya Rawat Inap RSUD',
                'tanggal_diajukan' => now()->subDays(4),
                'status' => 'Ditolak Sekdes',
                'keterangan_ditolak' => 'Persyaratan foto dokumen KK kurang jelas.',
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            [
                'id_surat' => 3,
                'nik' => '3508161010150002', // Kevin Pratama
                'keperluan' => 'Surat Keterangan Tempat Tinggal Sementara',
                'tanggal_diajukan' => now()->subHours(5),
                'status' => 'Diajukan',
                'keterangan_ditolak' => null,
                'created_at' => now()->subHours(5),
                'updated_at' => now()->subHours(5),
            ]
        ]);
    }
}
