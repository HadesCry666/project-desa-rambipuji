<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\master_pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PengajuanControllerMobile extends Controller
{
    /**
     * Buat pengajuan surat baru oleh user yang sedang login.
     * NIK diambil dari token Sanctum — tidak bisa di-spoof via request body.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_surat'        => 'required|string|exists:master_surat,id_surat',
                'keterangan'      => 'required|string|max:255',
                'tanggal_diajukan'=> 'required|date',
                'foto1'           => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                'foto2'           => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                'foto3'           => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                'foto4'           => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                'foto5'           => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                'foto6'           => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                'foto7'           => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                'foto8'           => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            ], [
                'id_surat.required'         => 'Jenis surat wajib dipilih.',
                'id_surat.exists'           => 'Jenis surat tidak valid.',
                'keterangan.required'       => 'Keterangan/keperluan wajib diisi.',
                'keterangan.max'            => 'Keterangan maksimal 255 karakter.',
                'tanggal_diajukan.required' => 'Tanggal pengajuan wajib diisi.',
                'tanggal_diajukan.date'     => 'Format tanggal tidak valid.',
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

        // Cek apakah sudah ada pengajuan aktif untuk surat yang sama
        $existing = master_pengajuan::where('id_surat', $request->id_surat)
            ->where('nik', $nik)
            ->whereNotIn('status', ['Ditolak', 'Selesai'])
            ->first();

        if ($existing) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Anda telah mengajukan surat ini dan masih dalam proses verifikasi.',
            ], 409);
        }

        // Upload foto berkas persyaratan
        $fotoPaths = [];
        for ($i = 1; $i <= 8; $i++) {
            $foto = $request->file('foto' . $i);
            if ($foto) {
                $filename          = 'foto' . $i . '_' . Str::random(10) . '.' . $foto->getClientOriginalExtension();
                $path              = $foto->storeAs('foto_pengajuan', $filename, 'public');
                $fotoPaths['foto' . $i] = 'storage/' . $path;
            } else {
                $fotoPaths['foto' . $i] = null;
            }
        }

        $pengajuan = master_pengajuan::create([
            'id_surat'         => $request->id_surat,
            'nik'              => $nik,
            'keperluan'        => $request->keterangan,
            'tanggal_diajukan' => $request->tanggal_diajukan,
            'status'           => 'Diajukan',
            'foto1'            => $fotoPaths['foto1'],
            'foto2'            => $fotoPaths['foto2'],
            'foto3'            => $fotoPaths['foto3'],
            'foto4'            => $fotoPaths['foto4'],
            'foto5'            => $fotoPaths['foto5'],
            'foto6'            => $fotoPaths['foto6'],
            'foto7'            => $fotoPaths['foto7'],
            'foto8'            => $fotoPaths['foto8'],
            'file_pdf'         => '-',
        ]);

        return response()->json([
            'status'       => 'success',
            'message'      => 'Pengajuan berhasil dikirim! Silakan tunggu proses verifikasi.',
            'id_pengajuan' => $pengajuan->id_pengajuan,
        ], 201);
    }
}