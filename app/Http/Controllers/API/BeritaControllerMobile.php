<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\master_berita;
use Illuminate\Http\Request;

class BeritaControllerMobile extends Controller
{
    public function index()
    {
        $berita = master_berita::with('penulis')
            ->latest()
            ->get()
            ->map(function ($item) {

                // ambil gambar pertama dari deskripsi
                preg_match('/<img[^>]+src="([^">]+)"/', $item->deskripsi, $matches);

                $gambar = $matches[1] ?? null;

                return [
                    'idberita' => $item->id_berita,
                    'judul' => $item->judul,
                    'created_at' => optional($item->created_at)->format('d-m-Y'),
                    'deskripsi' => $item->deskripsi,
                    'gambar' => $gambar,
                    'nik' => $item->nik,
                    'nama' => optional($item->penulis)->nama_lengkap,
                ];
            });

        return response()->json($berita);
    }

    public function show($id)
    {
        $berita = master_berita::with('penulis')
            ->where('id_berita', $id)
            ->first();

        if (!$berita) {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }

        // ambil gambar pertama dari deskripsi
        preg_match('/<img[^>]+src="([^">]+)"/', $berita->deskripsi, $matches);

        $gambar = $matches[1] ?? null;

        return response()->json([
            'idberita' => $berita->id_berita,
            'judul' => $berita->judul,
            'created_at' => optional($berita->created_at)->format('d-m-Y'),
            'deskripsi' => $berita->deskripsi,
            'gambar' => $gambar,
            'nik' => $berita->nik,
            'nama' => optional($berita->penulis)->nama_lengkap,
        ]);
    }
}