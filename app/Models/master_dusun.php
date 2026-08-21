<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class master_dusun extends Model
{
    protected $table = 'master_dusun';
    public $timestamps = true;
    protected $primaryKey = 'id_dusun';

    protected $fillable = [
        'nama_dusun',
        'nama_kasun',
        'nik'
    ];
}