<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\master_pengajuan;
use App\Models\View_data_pengajuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class KadusControllerMobile extends Controller
{
    /**
     * Dashboard Statistics untuk Kepala Dusun di Mobile.
     */
    public function dashboard(Request $request)
    {
        $suratMasukCount = master_pengajuan::where('status', 'Diajukan')->count();
        $diprosesCount   = master_pengajuan::whereIn('status', [
            'Disetujui Kepala Dusun',
            'Disetujui Admin',
            'Disetujui Sekretaris Desa',
        ])->count();
        $selesaiCount    = master_pengajuan::where('status', 'Selesai')->count();
        $ditolakCount    = master_pengajuan::where('status', 'Ditolak')->count();

        return response()->json([
            'status' => 'success',
            'data'   => [
                'surat_masuk' => $suratMasukCount,
                'diproses'    => $diprosesCount,
                'selesai'     => $selesaiCount,
                'ditolak'     => $ditolakCount,
            ],
        ]);
    }

    /**
     * Ambil daftar No. Kartu Keluarga (KK).
     */
    public function getKartuKeluarga(Request $request)
    {
        $data = DB::table('master_kartukeluargas')
            ->select('no_kk', 'nama_lengkap AS kepala_keluarga', 'alamat', 'rt', 'rw')
            ->orderBy('no_kk', 'asc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $data,
        ]);
    }

    /**
     * Ambil daftar anggota keluarga berdasarkan No. KK.
     */
    public function getAnggotaKeluarga(Request $request, $no_kk)
    {
        $anggota = DB::table('master_penduduks')
            ->where('no_kk', $no_kk)
            ->select('nik', 'nama_lengkap', 'jenis_kelamin', 'status_keluarga')
            ->get();

        return response()->json([
            'status' => 'success',
            'no_kk'  => $no_kk,
            'data'   => $anggota,
        ]);
    }

    /**
     * Kepala Dusun membuat pengajuan surat atas nama warga.
     * Status pengajuan LANGSUNG menjadi 'Disetujui Kepala Dusun'.
     */
    public function storePengajuan(Request $request)
    {
        try {
            $request->validate([
                'nik'             => 'required|string|size:16|exists:master_penduduks,nik',
                'id_surat'        => 'required|string|exists:master_surat,id_surat',
                'keterangan'      => 'required|string|max:255',
                'tanggal_diajukan'=> 'required|date',
                'foto1'           => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                'foto2'           => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                'foto3'           => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            ], [
                'nik.required'              => 'Warga wajib dipilih.',
                'nik.exists'                => 'NIK warga tidak valid.',
                'id_surat.required'         => 'Jenis surat wajib dipilih.',
                'keterangan.required'       => 'Keperluan wajib diisi.',
                'tanggal_diajukan.required' => 'Tanggal pengajuan wajib diisi.',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => collect($e->errors())->flatten()->first(),
                'errors'  => $e->errors(),
            ], 422);
        }

        $fotoPaths = [];
        for ($i = 1; $i <= 8; $i++) {
            $foto = $request->file('foto' . $i);
            if ($foto) {
                $filename = 'foto' . $i . '_' . Str::random(10) . '.' . $foto->getClientOriginalExtension();
                $path     = $foto->storeAs('foto_pengajuan', $filename, 'public');
                $fotoPaths['foto' . $i] = 'storage/' . $path;
            } else {
                $fotoPaths['foto' . $i] = null;
            }
        }

        // Simpan dengan status LANGSUNG 'Disetujui Kepala Dusun'
        $pengajuan = master_pengajuan::create([
            'id_surat'         => $request->id_surat,
            'nik'              => $request->nik,
            'keperluan'        => $request->keterangan,
            'tanggal_diajukan' => $request->tanggal_diajukan,
            'status'           => 'Disetujui Kepala Dusun', // Direct approval by Kadus
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
            'message'      => 'Pengajuan atas nama warga berhasil dibuat dan otomatis disetujui Kepala Dusun (diteruskan ke Admin).',
            'id_pengajuan' => $pengajuan->id_pengajuan,
        ], 201);
    }

    /**
     * Tampilkan daftar Surat Masuk berstatus 'Diajukan' untuk Kadus di Mobile.
     */
    public function suratmasuk(Request $request)
    {
        $data = View_data_pengajuan::where('status', 'Diajukan')
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
     * Kadus Setujui Surat dari Mobile -> ubah status ke 'Disetujui Kepala Dusun'.
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

        $pengajuan->status = 'Disetujui Kepala Dusun';
        $pengajuan->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Pengajuan berhasil disetujui oleh Kepala Dusun dan diteruskan ke Admin.',
        ]);
    }

    /**
     * Kadus Tolak Surat dari Mobile -> ubah status ke 'Ditolak'.
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
            'message' => 'Pengajuan telah ditolak.',
        ]);
    }
}
