<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\master_kartukeluarga;
use App\Models\master_penduduk;
use Carbon\Carbon;

class PendudukImport implements ToCollection, WithHeadingRow
{
    protected $errors = [];
    public function getErrors()
{
    return $this->errors;
}
    public function collection(Collection $rows)
{
    foreach ($rows as $index => $row) {

        $baris = $index + 2; // karena baris 1 adalah header

        // =================== VALIDASI ===================

        if (empty(trim($row['nomor_kk'] ?? ''))) {
            $this->errors[] = "Baris {$baris}: Nomor KK kosong.";
            continue;
        }

        if (empty(trim($row['nomor_ktp'] ?? ''))) {
            $this->errors[] = "Baris {$baris}: Nomor KTP kosong.";
            continue;
        }

        if (empty(trim($row['nama'] ?? ''))) {
            $this->errors[] = "Baris {$baris}: Nama kosong.";
            continue;
        }

        // Validasi NIK harus 16 digit
        $nik = preg_replace('/\D/', '', trim($row['nomor_ktp']));

        if (strlen($nik) > 16) {
            $this->errors[] = "Baris {$baris}: Nomor KTP lebih dari 16 digit.";
            continue;
        }

        if (strlen($nik) < 16) {
            $this->errors[] = "Baris {$baris}: Nomor KTP kurang dari 16 digit.";
            continue;
        }

        // =================== TANGGAL ===================

        $tanggalLahir = null;

        if (!empty($row['tanggal_lahir'])) {
            try {
                $tanggal = str_replace('|', '/', trim($row['tanggal_lahir']));

                $tanggalLahir = Carbon::createFromFormat('d/m/Y', $tanggal)
                    ->format('Y-m-d');
            } catch (\Exception $e) {
                $this->errors[] = "Baris {$baris}: Format tanggal tidak valid.";
                continue;
            }
        }

        // =================== FORMAT ===================

        $jenisKelamin = match (strtoupper(trim($row['kelamin'] ?? ''))) {
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
            default => null,
        };

        $statusPerkawinan = match (strtoupper(trim($row['sts_kawin'] ?? ''))) {
            'B' => 'Belum Kawin',
            'S' => 'Kawin',
            'P' => 'Cerai',
            default => null,
        };

        $nama = ucwords(strtolower(trim($row['nama'])));
        $tempatLahir = ucwords(strtolower(trim($row['tempat_lahir'] ?? '')));

        // =================== SIMPAN KK ===================

        master_kartukeluarga::firstOrCreate(
            [
                'no_kk' => $row['nomor_kk']
            ],
            [
                'alamat'     => ucwords(strtolower(trim($row['alamat']))),
                'rt'         => $row['rt'],
                'rw'         => $row['rw'],
                'desa'       => ucwords(strtolower(trim($row['kelurahan']))),
                'kecamatan'  => ucwords(strtolower(trim($row['kecamatan']))),
                'kode_pos'   => 68152,
                'kabupaten'  => 'Jember',
                'provinsi'   => 'Jawa Timur'
            ]
        );

        // =================== SIMPAN PENDUDUK ===================

        master_penduduk::updateOrCreate(
            [
                'nik' => $nik
            ],
            [
                'nama_lengkap'      => $nama,
                'jenis_kelamin'     => $jenisKelamin,
                'tempat_lahir'      => $tempatLahir,
                'tanggal_lahir'     => $tanggalLahir,
                'status_perkawinan' => $statusPerkawinan,
                'no_kk'             => $row['nomor_kk']
            ]
        );
    }
}
}