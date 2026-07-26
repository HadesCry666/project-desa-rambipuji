<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\master_pengaduan;
use Illuminate\Validation\ValidationException;

class PengaduanControllerMobile extends Controller
{
    /**
     * Kirim pengaduan baru oleh user yang sedang login.
     * NIK diambil dari token Sanctum — tidak bisa di-spoof via request body.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'ulasan'   => 'required|string|max:1000',
                'foto1'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'kategori' => 'required|string|in:Infrastruktur,Pelayanan,Keamanan,Lingkungan,Lainnya',
            ], [
                'ulasan.required'   => 'Isi pengaduan wajib diisi.',
                'ulasan.max'        => 'Isi pengaduan maksimal 1000 karakter.',
                'foto1.image'       => 'File harus berupa gambar.',
                'foto1.mimes'       => 'Format gambar harus JPG, JPEG, atau PNG.',
                'foto1.max'         => 'Ukuran foto maksimal 2MB.',
                'kategori.required' => 'Kategori pengaduan wajib dipilih.',
                'kategori.in'       => 'Kategori tidak valid.',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => collect($e->errors())->flatten()->first(),
                'errors'  => $e->errors(),
            ], 422);
        }

        // NIK diambil dari token — tidak bisa di-spoof
        $nik = $request->user()->nik;

        $foto1Path = null;
        if ($request->hasFile('foto1')) {
            $foto1Path = $request->file('foto1')->store('pengaduan_foto', 'public');
        }

        $data = master_pengaduan::create([
            'nik'      => $nik,
            'ulasan'   => $request->ulasan,
            'foto1'    => $foto1Path,
            'kategori' => $request->kategori,
            'feedback' => null,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Pengaduan berhasil dikirim. Kami akan segera menindaklanjuti.',
            'data'    => [
                'id'       => $data->id,
                'kategori' => $data->kategori,
                'ulasan'   => $data->ulasan,
            ],
        ], 201);
    }
}