<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\master_pengajuan;
use App\Models\View_data_pengajuan;
use App\Http\Controllers\Admin\GeneratePDFController;
use Illuminate\Support\Facades\DB;

class KadesControllerMobile extends Controller
{
    /**
     * Dashboard Statistics untuk Kepala Desa di Mobile.
     */
    public function dashboard(Request $request)
    {
        $menungguCount = master_pengajuan::where('status', 'Disetujui Sekretaris Desa')->count();
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
     * Tampilkan daftar Surat Masuk berstatus 'Disetujui Sekretaris Desa' untuk Kades di Mobile.
     */
    public function suratmasuk(Request $request)
    {
        $data = View_data_pengajuan::where('status', 'Disetujui Sekretaris Desa')
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
     * Kades Setujui Surat dari Mobile:
     * 1. Ubah status menjadi 'Selesai'
     * 2. Panggil GeneratePDFController untuk buat PDF resmi + TTD Digital Kades
     * 3. Simpan file PDF & kembalikan URL file PDF
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

        $pengajuan->status = 'Selesai';
        $pengajuan->save();

        try {
            $generate = new GeneratePDFController();
            $generate->generateAndStorePdf($id);
        } catch (\Exception $e) {
            // PDF Generator dipanggil
        }

        // Ambil data terbaru untuk mengembalikan file_pdf_url
        $updated = master_pengajuan::find($id);
        $pdfUrl = null;
        if ($updated->file_pdf && $updated->file_pdf !== '-') {
            $pdfUrl = asset('storage/generatesurat/' . basename($updated->file_pdf));
        }

        return response()->json([
            'status'       => 'success',
            'message'      => 'Surat berhasil disahkan dengan Tanda Tangan Digital Kepala Desa.',
            'file_pdf_url' => $pdfUrl,
        ]);
    }

    /**
     * Kades Tolak Surat dari Mobile -> ubah status ke 'Ditolak'.
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
            'message' => 'Pengajuan surat ditolak oleh Kepala Desa.',
        ]);
    }

    /**
     * Monitoring Pengaduan Masyarakat (Read-Only) untuk Kades.
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
