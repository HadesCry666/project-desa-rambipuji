<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\master_pengajuan;
use Illuminate\Support\Facades\DB;

class StatusDiajukanControllerMobile extends Controller
{
    /**
     * Tampilkan daftar pengajuan yang sedang diproses milik user yang sedang login.
     * Status: Diajukan, Disetujui Kepala Dusun, Disetujui Admin, Disetujui Sekretaris Desa.
     * NIK diambil dari token Sanctum — tidak bisa di-spoof.
     */
    public function index(Request $request)
    {
        $nik = $request->user()->nik;

        $data = DB::table('master_pengajuan')
            ->join('master_surat', 'master_pengajuan.id_surat', '=', 'master_surat.id_surat')
            ->select(
                'master_pengajuan.id_pengajuan',
                'master_surat.nama_surat',
                'master_pengajuan.keperluan',
                'master_pengajuan.tanggal_diajukan',
                'master_pengajuan.status',
                'master_pengajuan.keterangan_admin',
                'master_pengajuan.created_at',
            )
            ->where('master_pengajuan.nik', $nik)
            ->whereIn('master_pengajuan.status', [
                'Diajukan',
                'Disetujui Kepala Dusun',
                'Disetujui Admin',
                'Disetujui Sekretaris Desa',
            ])
            ->orderBy('master_pengajuan.created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'total'  => $data->count(),
            'data'   => $data,
        ]);
    }

    /**
     * Hapus pengajuan milik user yang sedang login.
     * Hanya boleh hapus pengajuan milik sendiri yang masih berstatus 'Diajukan'.
     */
    public function destroy(Request $request, $id)
    {
        $nik = $request->user()->nik;

        $pengajuan = master_pengajuan::find($id);

        if (!$pengajuan) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Pengajuan tidak ditemukan.',
            ], 404);
        }

        // Pastikan pengajuan milik user yang login
        if ($pengajuan->nik !== $nik) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Akses ditolak. Pengajuan bukan milik Anda.',
            ], 403);
        }

        // Hanya boleh hapus jika masih berstatus 'Diajukan'
        if ($pengajuan->status !== 'Diajukan') {
            return response()->json([
                'status'  => 'error',
                'message' => 'Pengajuan tidak dapat dihapus karena sudah dalam proses verifikasi.',
            ], 422);
        }

        $pengajuan->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Pengajuan berhasil dihapus.',
        ]);
    }
}
