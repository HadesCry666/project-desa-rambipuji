<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\master_penduduk;
use App\Models\master_surat;
use App\Models\master_pengajuan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TambahPengajuanController extends Controller
{
    public function index()
    {
        $datapenduduk = master_penduduk::orderBy('nama_lengkap')->get();
        $datasurat    = master_surat::orderBy('nama_surat')->get();

        return view('admin.pengajuan_surat.tambah_pengajuan', compact('datapenduduk', 'datasurat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_registrasi' => 'required|string|max:100',
            'nik'           => 'required|string|exists:master_penduduks,nik',
            'id_surat'      => 'required|string|exists:master_surat,id_surat',
            'keperluan'     => 'nullable|string|max:500',
            'foto'          => 'nullable|array|max:8',
            'foto.*'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'no_registrasi.required' => 'Nomor Registrasi Kepala Dusun wajib diisi.',
            'nik.required'           => 'NIK / Nama Penduduk wajib dipilih.',
            'id_surat.required'      => 'Jenis Surat wajib dipilih.',
        ]);

        $data = [
            'no_registrasi'    => $request->no_registrasi,
            'nik'              => $request->nik,
            'id_surat'         => $request->id_surat,
            'keperluan'        => $request->keperluan,
            'status'           => 'Disetujui Kepala Dusun', // TTD RT/RW fisik (basah), langsung siap diproses Admin
            'tanggal_diajukan' => Carbon::now()->toDateString(),
        ];

        // Upload foto jika ada (maks 8)
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $index => $file) {
                if ($index >= 8) break;
                $fotoKey        = 'foto' . ($index + 1);
                $path           = $file->store('pengajuan', 'public');
                $data[$fotoKey] = 'storage/' . $path;
            }
        }

        master_pengajuan::create($data);

        return redirect()->route('pengajuan.tambah.index')
            ->with('success', 'Pengajuan surat berhasil ditambahkan dengan Nomor Registrasi Kepala Dusun.');
    }
}
