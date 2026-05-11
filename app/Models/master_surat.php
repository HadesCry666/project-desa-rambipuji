<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_surat extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'id_surat';

    // Tabel yang digunakan
    protected $table = 'master_surat';

    // Kolom yang boleh diisi
    protected $fillable = [

    'id_surat',
    'nama_surat',
    'keterangan',
    'slug',

    'berkas1',
    'berkas2',
    'berkas3',
    'berkas4',
    'berkas5',
    'berkas6',
    'berkas7',
    'berkas8',
    'berkas9',

];

    // Nonaktifkan timestamps (jika tidak digunakan)
    public $timestamps = true;

    // Relasi ke master_pengajuan
    public function pengajuan()
    {
        return $this->hasMany(master_pengajuan::class, 'id_surat');
    }
}