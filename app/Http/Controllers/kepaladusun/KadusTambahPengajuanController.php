<?php

namespace App\Http\Controllers\KepalaDusun;

use App\Http\Controllers\Controller;
use App\Models\master_penduduk;
use App\Models\master_surat;
use App\Models\master_pengajuan;
use App\Models\master_kartukeluarga;
use App\Models\master_dusun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KadusTambahPengajuanController extends Controller
{
    public function index() 
    { 
        $datapenduduk = master_penduduk::orderBy('nama_lengkap')->get(); 
        $datasurat = master_surat::orderBy('nama_surat')->get();  
        $nikKadus = session('nik') ?? Auth::user()->nik; 
        $dusun = master_dusun::where('nik', $nikKadus) 
            ->first(); 
            if (!$dusun) { 
                return back()->withErrors([ 'no_registrasi' => 'Data dusun Kepala Dusun tidak ditemukan.' 
                ]); 
            }  
            
            $nomorDusun = str_pad( $dusun->id_dusun, 2, '0', STR_PAD_LEFT ); 
            
            $pengajuanTerakhir = master_pengajuan::orderByDesc('id_pengajuan') 
                ->first(); 
                
                if ($pengajuanTerakhir && $pengajuanTerakhir->no_registrasi) { 
                    $parts = explode( '/', $pengajuanTerakhir->no_registrasi ); 
                    $nomorUrut = isset($parts[1]) ? ((int) $parts[1]) + 1 : 1; 
                    } else { 
                        $nomorUrut = 1; 
                        } $nomorUrut = str_pad( $nomorUrut, 3, '0', STR_PAD_LEFT ); 
                        
            $bulanRomawi = [ 1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII', ]; 
            $tanggal = Carbon::now(); $bulan = $bulanRomawi[$tanggal->month]; $tahun = $tanggal->year;
                        
            $noRegistrasi = "407/{$nomorUrut}/2006.{$nomorDusun}/{$bulan}/{$tahun}"; 
                return view( 'kepaladusun.tambah_pengajuan.index', compact( 'datapenduduk', 'datasurat', 'noRegistrasi' ) ); 
            }
    

    /**
     * Ambil daftar Kartu Keluarga untuk dropdown (AJAX).
     */
    public function getKKList()
    {
        $data = DB::table('master_kartukeluargas')
            ->select('no_kk', 'alamat', 'rt', 'rw')
            ->orderBy('no_kk')
            ->get();

        return response()->json(['status' => 'success', 'data' => $data]);
    }

    /**
     * Ambil daftar anggota keluarga berdasarkan No. KK (AJAX).
     */
    public function getAnggotaKK($no_kk)
    {
        $anggota = DB::table('master_penduduks')
            ->where('no_kk', $no_kk)
            ->select('nik', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'status_keluarga')
            ->get();

        return response()->json(['status' => 'success', 'no_kk' => $no_kk, 'data' => $anggota]);
    }

    /**
     * Ambil data penduduk berdasarkan NIK (AJAX).
     */
    public function getPendudukByNik(Request $request)
    {
        $nik = $request->nik;
        $penduduk = master_penduduk::where('nik', $nik)->first();

        if (!$penduduk) {
            return response()->json(['status' => 'error', 'message' => 'Penduduk tidak ditemukan.'], 404);
        }

        // Ambil info KK
        $kk = DB::table('master_kartukeluargas')->where('no_kk', $penduduk->no_kk)->first();

        return response()->json([
            'status'           => 'success',
            'nik'              => $penduduk->nik,
            'nama_lengkap'     => $penduduk->nama_lengkap,
            'no_kk'            => $penduduk->no_kk,
            'jenis_kelamin'    => $penduduk->jenis_kelamin,
            'tempat_lahir'     => $penduduk->tempat_lahir,
            'tanggal_lahir'    => $penduduk->tanggal_lahir,
            'status_keluarga'  => $penduduk->status_keluarga,
            'alamat'           => $kk ? $kk->alamat : '-',
            'rt'               => $kk ? $kk->rt : '-',
            'rw'               => $kk ? $kk->rw : '-',
        ]);
    }

    /**
     * Simpan pengajuan surat yang dibuat oleh Kepala Dusun atas nama Warga.
     * Status langsung: 'Disetujui Kepala Dusun' -> masuk ke antrian Admin Desa.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_registrasi' => 'required|string|max:100',
            'nik'           => 'required|string|size:16|exists:master_penduduks,nik',
            'id_surat'      => 'required|string|exists:master_surat,id_surat',
            'keperluan'     => 'required|string|max:500',
            'foto'          => 'nullable|array|max:9',
            'foto.*'        => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ], [
            'no_registrasi.required' => 'Nomor registrasi wajib tersedia.',
            'nik.required'           => 'Warga wajib dipilih.',
            'nik.exists'             => 'NIK warga tidak valid atau tidak terdaftar.',
            'id_surat.required'      => 'Jenis surat wajib dipilih.',
            'keperluan.required'     => 'Keperluan surat wajib diisi.',
        ]);

        $data = [
            'no_registrasi'    => $request->no_registrasi,
            'nik'              => $request->nik,
            'id_surat'         => $request->id_surat,
            'keperluan'        => $request->keperluan,
            'status'           => 'Disetujui Kepala Dusun',
            'tanggal_diajukan' => Carbon::now()->toDateString(),
        ];


        // Upload foto (maks 9)
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $index => $file) {
                if ($index >= 9) break;
                $fotoKey        = 'foto' . ($index + 1);
                $path           = $file->store('pengajuan_kadus', 'public');
                $data[$fotoKey] = 'storage/' . $path;
            }
        }

        master_pengajuan::create($data);

        return redirect()->route('kadus.suratselesai.index')
            ->with('success', 'Pengajuan surat berhasil dibuat dan langsung masuk ke antrian Admin Desa.');
    }
}
