<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\master_surat;

class SuratController extends Controller
{
    /**
     * Mengembalikan daftar semua jenis surat layanan desa beserta berkas syaratnya.
     */
    public function index()
    {
        $suratList = master_surat::all()->map(function ($item) {
            $berkas = [];
            for ($i = 1; $i <= 9; $i++) {
                $field = 'berkas' . $i;
                if (!empty($item->$field) && $item->$field !== '-') {
                    $berkas[] = $item->$field;
                }
            }

            return [
                'id_surat'   => $item->id_surat,
                'nama_surat' => $item->nama_surat,
                'slug'       => $item->slug,
                'keterangan' => $item->keterangan,
                'syarat'     => $berkas,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data'   => $suratList,
        ], 200);
    }
}