<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\master_kartukeluarga;
use App\Models\master_penduduk;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class PendudukImport implements ToCollection, WithHeadingRow
{
    protected $errors = [];

    public function getErrors()
    {
        return $this->errors;
    }

    public function collection(Collection $rows)
    {
        DB::transaction(function () use ($rows) {

            foreach ($rows as $index => $row) {

                $baris = $index + 2; // Baris 1 adalah header Excel

                // =================== VALIDASI NOMOR KK ===================

                $noKK = preg_replace('/\D/', '', trim($row['nomor_kk'] ?? ''));

                if (empty($noKK)) {
                    $this->errors[] = "Baris {$baris}: Nomor KK kosong.";
                } elseif (strlen($noKK) !== 16) {
                    $this->errors[] = "Baris {$baris}: Nomor KK harus tepat 16 digit (terdeteksi " . strlen($noKK) . " digit).";
                }

                // =================== VALIDASI NIK / KTP ===================

                $nik = preg_replace('/\D/', '', trim($row['nomor_ktp'] ?? ''));

                if (empty($nik)) {
                    $this->errors[] = "Baris {$baris}: Nomor KTP kosong.";
                } elseif (strlen($nik) !== 16) {
                    $this->errors[] = "Baris {$baris}: Nomor KTP/NIK harus tepat 16 digit (terdeteksi " . strlen($nik) . " digit).";
                }

                // =================== VALIDASI NAMA ===================

                if (empty(trim($row['nama'] ?? ''))) {
                    $this->errors[] = "Baris {$baris}: Nama kosong.";
                }

                // =================== CEK TANGGAL LAHIR ===================

                $tanggalLahir = null;

                if (!empty($row['tanggal_lahir'])) {
                    try {
                        $tanggal = str_replace('|', '/', trim($row['tanggal_lahir']));
                        $tanggalLahir = Carbon::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d');
                    } catch (\Exception $e) {
                        $this->errors[] = "Baris {$baris}: Format tanggal lahir tidak valid.";
                    }
                }

                // Jika ada error pada baris ini atau baris sebelumnya, lanjut kumpulkan error tanpa query DB
                if (!empty($this->errors)) {
                    continue;
                }

                // =================== EKSTRAKSI DUSUN AUTOMATIS ===================

                $alamatMentah = trim($row['alamat'] ?? '');
                $dusun = null;

                if (!empty($alamatMentah)) {
                    // 1. Ekstraksi nama dusun dari alamat
                    if (preg_match('/(?:\b(?:dusun|dusu|dsn)\b|\bds\b)\s+([a-z0-9\s]+?)(?=[,\.\d]|\bjl\b|\brt\b|\brw\b|$)/i', $alamatMentah, $matches)) {
                        $extractedDusun = trim($matches[1]);

                        if (!empty($extractedDusun)) {
                            // 2. Format menjadi Title Case (setiap kata diawali huruf kapital)
                            $dusunFormatted = ucwords(strtolower($extractedDusun));

                            // 3. Mapping untuk penyesuaian nama resmi yang benar (pakai spasi)
                            $mapDusun = [
                                'Gudangrejo'  => 'Gudang Rejo',
                                'Krajanbarat' => 'Krajan Barat',
                                'Krajantimur' => 'Krajan Timur',
                                'Kidulpasar'  => 'Kidul Pasar',
                                'Gudangkarang'=> 'Gudang Karang',
                                'Curahancar'  => 'Curah Ancar',
                                'Kaliputih'   => 'Kaliputih',
                                'Kali Putih'  => 'Kaliputih'

                                // Tambahkan pasangan dusun lainnya jika ada variasi tanpa spasi
                            ];

                            // 4. Jika terdeteksi tanpa spasi, ubah ke nama baku. Jika tidak, gunakan nama asli hasil ekstraksi
                            $dusun = $mapDusun[$dusunFormatted] ?? $dusunFormatted;

                            // Potong maksimal 50 karakter demi keamanan DB
                            $dusun = substr($dusun, 0, 50);
                        }
                    }
                }

                // =================== FORMATTING DATA ===================

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
                        'no_kk' => $noKK
                    ],
                    [
                        'alamat'     => ucwords(strtolower($alamatMentah)),
                        'dusun'      => $dusun,
                        'rt'         => $row['rt'] ?? null,
                        'rw'         => $row['rw'] ?? null,
                        'desa'       => ucwords(strtolower(trim($row['kelurahan'] ?? ''))),
                        'kecamatan'  => ucwords(strtolower(trim($row['kecamatan'] ?? ''))),
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
                        'no_kk'             => $noKK
                    ]
                );
            }

            // =================== JIKA ADA ERROR, ROLLBACK TRANSACTION ===================

            if (!empty($this->errors)) {
                // Lempar exception dengan format JSON agar bisa didecode oleh Controller
                throw new Exception(json_encode($this->errors));
            }
        });
    }
}