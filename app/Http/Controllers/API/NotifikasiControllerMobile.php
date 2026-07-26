<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\notifikasi_pengajuan;
use App\Models\master_pengaduan;

class NotifikasiControllerMobile extends Controller
{
    /**
     * Tampilkan daftar notifikasi milik user yang sedang login.
     * NIK diambil dari token Sanctum — tidak bisa di-spoof via query parameter.
     */
    public function index(Request $request)
    {
        $nik = $request->user()->nik;

        // Ambil notifikasi pengajuan
        $pengajuan = notifikasi_pengajuan::where('nik', $nik)
            ->where('jenis', 'pengajuan')
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil notifikasi pengaduan
        $pengaduan = notifikasi_pengajuan::where('nik', $nik)
            ->where('jenis', 'pengaduan')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => [
                'pengajuan' => $pengajuan,
                'pengaduan' => $pengaduan,
            ]
        ], 200);
    }

    /**
     * Tampilkan detail pengaduan berdasarkan ID.
     */
    public function show(Request $request, $id)
    {
        $nik = $request->user()->nik;

        $data = master_pengaduan::where('id', $id)
            ->where('nik', $nik)
            ->first();

        if (!$data) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data pengaduan tidak ditemukan atau bukan milik Anda.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => [
                'id'         => $data->id,
                'nik'        => $data->nik,
                'ulasan'     => $data->ulasan,
                'foto1'      => $data->foto1 ? asset('storage/' . $data->foto1) : null,
                'feedback'   => $data->feedback,
                'kategori'   => $data->kategori,
                'created_at' => $data->created_at,
                'updated_at' => $data->updated_at,
            ]
        ], 200);
    }

    /**
     * Hapus / Tandai notifikasi sebagai dibaca.
     */
    public function markAsRead(Request $request, $id)
    {
        $nik = $request->user()->nik;

        $notif = notifikasi_pengajuan::where('id', $id)
            ->where('nik', $nik)
            ->first();

        if (!$notif) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Notifikasi tidak ditemukan.'
            ], 404);
        }

        $notif->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Notifikasi berhasil dibaca.'
        ], 200);
    }
}