<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\master_pengajuan;
use App\Models\master_pengaduan;
use App\Models\View_data_pengajuan;
use Illuminate\Support\Facades\DB;

class SekdesControllerMobile extends Controller
{
    /**
     * Dashboard Statistics untuk Sekretaris Desa di Mobile.
     */
    public function dashboard(Request $request)
    {
        $menungguCount = master_pengajuan::where('status', 'Disetujui Admin')->count();
        $selesaiCount  = master_pengajuan::where('status', 'Selesai')->count();
        $ditolakCount  = master_pengajuan::where('status', 'Ditolak')->count();

        return response()->json([
            'status' => 'success',
            'data'   => [
                'menunggu_persetujuan' => $menungguCount,
                'selesai'              => $selesaiCount,
                'ditolak'              => $ditolakCount,
            ],
        ]);
    }

    /**
     * Tampilkan daftar Surat Masuk berstatus 'Disetujui Admin' untuk Sekdes di Mobile.
     * Mengembalikan Data Pemohon, Lampiran, Keterangan Admin, dan Riwayat.
     */
    public function suratmasuk(Request $request)
    {
        $data = View_data_pengajuan::where('status', 'Disetujui Admin')
            ->orderBy('id_pengajuan', 'desc')
            ->get();

        // Transformasi URL foto agar siap dipakai oleh Flutter
        $data->transform(function ($item) {
            for ($i = 1; $i <= 8; $i++) {
                $key = 'foto' . $i;
                $item->$key = $item->$key ? asset('storage/' . $item->$key) : null;
            }
            return $item;
        });

        return response()->json([
            'status' => 'success',
            'total'  => $data->count(),
            'data'   => $data,
        ]);
    }

    /**
     * Sekdes Setujui Surat dari Mobile -> ubah status ke 'Disetujui Sekretaris Desa'.
     */
    public function setuju(Request $request, $id)
    {
        $pengajuan = master_pengajuan::find($id);

        if (!$pengajuan) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Pengajuan tidak ditemukan.',
            ], 404);
        }

        $pengajuan->status = 'Disetujui Sekretaris Desa';
        $pengajuan->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Pengajuan berhasil disetujui oleh Sekretaris Desa dan diteruskan ke Kepala Desa.',
        ]);
    }

    /**
     * Sekdes Tolak Surat dari Mobile -> ubah status ke 'Ditolak'.
     */
    public function tolak(Request $request, $id)
    {
        $request->validate([
            'keterangan_ditolak' => 'required|string|max:255',
        ], [
            'keterangan_ditolak.required' => 'Alasan penolakan wajib diisi.',
        ]);

        $pengajuan = master_pengajuan::find($id);

        if (!$pengajuan) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Pengajuan tidak ditemukan.',
            ], 404);
        }

        $pengajuan->status = 'Ditolak';
        $pengajuan->keterangan_ditolak = $request->keterangan_ditolak;
        $pengajuan->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Pengajuan telah ditolak oleh Sekretaris Desa.',
        ]);
    }

    /**
     * Monitoring Pengaduan Masyarakat (Read-Only) untuk Sekdes.
     */
    public function pengaduan(Request $request)
    {
        $pengaduan = DB::table('master_pengaduan')
            ->join('master_penduduks', 'master_pengaduan.nik', '=', 'master_penduduks.nik')
            ->select(
                'master_pengaduan.id',
                'master_pengaduan.nik',
                'master_penduduks.nama_lengkap AS nama_pemohon',
                'master_pengaduan.kategori',
                'master_pengaduan.ulasan',
                'master_pengaduan.foto1',
                'master_pengaduan.feedback AS feedback_admin',
                'master_pengaduan.created_at',
                'master_pengaduan.updated_at'
            )
            ->orderBy('master_pengaduan.created_at', 'desc')
            ->get();

        $pengaduan->transform(function ($item) {
            $item->foto1_url = $item->foto1 ? asset('storage/' . $item->foto1) : null;
            $item->is_responded = !empty($item->feedback_admin);
            return $item;
        });

        return response()->json([
            'status' => 'success',
            'total'  => $pengaduan->count(),
            'data'   => $pengaduan,
        ]);
    }
}
