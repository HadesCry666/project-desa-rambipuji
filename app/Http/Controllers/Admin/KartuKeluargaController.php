<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\master_penduduk;
use App\Models\master_kartukeluarga;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PendudukImport;

class KartuKeluargaController extends Controller
{
    // Menampilkan daftar data
    public function index(Request $request)
    {
        $keyword = $request->katakunci;

        $query = master_penduduk::join(
            'master_kartukeluargas',
            'master_penduduks.no_kk', '=', 'master_kartukeluargas.no_kk'
        )->select(
            'master_kartukeluargas.kecamatan',
            'master_kartukeluargas.desa',
            'master_kartukeluargas.no_kk',
            'master_penduduks.nik',
            'master_penduduks.nama_lengkap',
            'master_penduduks.tempat_lahir',
            'master_penduduks.tanggal_lahir',
            'master_penduduks.status_perkawinan',
            'master_penduduks.jenis_kelamin',
            'master_kartukeluargas.alamat',
            'master_kartukeluargas.rt',
            'master_kartukeluargas.rw',
            'master_kartukeluargas.kode_pos',
            'master_kartukeluargas.kabupaten',
            'master_kartukeluargas.provinsi'
        )->orderBy('master_kartukeluargas.no_kk')
         ->orderByRaw("FIELD(master_penduduks.status_keluarga, 'KEPALA KELUARGA', 'Kepala Keluarga', 'SUAMI', 'ISTRI', 'ANAK')");

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('master_kartukeluargas.no_kk', 'LIKE', '%' . $keyword . '%')
                  ->orWhere('master_penduduks.nik', 'LIKE', '%' . $keyword . '%')
                  ->orWhere('master_penduduks.nama_lengkap', 'LIKE', '%' . $keyword . '%');
            });
        }

        $master_kartukeluarga = $query->paginate(15);

        return view('admin.master_kartukeluarga.index', compact('master_kartukeluarga'));
    }

    // Tambah data
    public function masuk(Request $request)
    {
        $request->validate([
            'no_kk' => 'required|digits:16|numeric|unique:master_kartukeluargas,no_kk',
            'alamat' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kode_pos' => 'required|numeric',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'nik' => 'required|numeric|digits:16|unique:master_penduduks,nik',
            'nama_lengkap' => 'required'
                ], [
                // ERROR NOMOR KK
                'no_kk.required' => 'Nomor KK wajib diisi',
                'no_kk.digits' => 'Nomor KK harus 16 digit',
                'no_kk.unique' => 'Nomor KK sudah digunakan',

                // ERROR NIK
                'nik.required' => 'NIK wajib diisi',
                'nik.digits' => 'NIK harus 16 digit',
                'nik.unique' => 'NIK sudah digunakan',
            ]);

        // Simpan KK
        $master_kartukeluarga = master_kartukeluarga::create([
            'no_kk' => $request->no_kk,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kode_pos' => $request->kode_pos,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
        ]);

        // Simpan kepala keluarga
        master_penduduk::create([
            'no_kk' => $master_kartukeluarga->no_kk,
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'status_keluarga' => 'KEPALA KELUARGA'
        ]);

        return redirect(url('admin/master_kartukeluarga'))
            ->with('success', 'Data kartu keluarga berhasil ditambahkan');
    }

    // Update data
    public function update(Request $request, $no_kk_lama)
    {
        $pendudukLama = master_penduduk::where('no_kk', $no_kk_lama)
            ->where(function ($q) {
                $q->where('status_keluarga', 'LIKE', '%KEPALA KELUARGA%')
                  ->orWhere('status_keluarga', 'LIKE', '%Kepala Keluarga%');
            })
            ->first();

        if (!$pendudukLama) {
            $pendudukLama = master_penduduk::where('no_kk', $no_kk_lama)->first();
        }

        if (!$pendudukLama) {
            return back()->withErrors([
                'nik' => 'Data kepala keluarga tidak ditemukan'
            ])->withInput();
        }

        $request->validate([
            'no_kk' => 'required|digits:16',
            'alamat' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kode_pos' => 'required|numeric',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'nik' => 'required|digits:16',
            'nama_lengkap' => 'required'
        ], [
            'no_kk.required' => 'Nomor KK wajib diisi',
            'nik.required' => 'NIK wajib diisi',
            'nama_lengkap.required' => 'Nama kepala keluarga wajib diisi'
        ]);

        // CEK NIK
        if ($request->nik != $pendudukLama->nik) {

            $cekNik = master_penduduk::where('nik', $request->nik)->exists();

            if ($cekNik) {
                return back()->withErrors([
                    'nik' => 'NIK sudah digunakan'
                ])->withInput();
            }
        }

        // CEK KK
        if ($request->no_kk != $no_kk_lama) {

            $cekKK = master_kartukeluarga::where('no_kk', $request->no_kk)->exists();

            if ($cekKK) {
                return back()->withErrors([
                    'no_kk' => 'Nomor KK sudah digunakan'
                ])->withInput();
            }
        }

        // Update KK
        master_kartukeluarga::where('no_kk', $no_kk_lama)->update([
            'no_kk' => $request->no_kk,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kode_pos' => $request->kode_pos,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi
        ]);

        // Update semua penduduk
        master_penduduk::where('no_kk', $no_kk_lama)->update([
            'no_kk' => $request->no_kk
        ]);

        // Update kepala keluarga
        master_penduduk::where('nik', $pendudukLama->nik)->update([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap
        ]);

        return redirect(url('admin/master_kartukeluarga'))
            ->with('success', 'Data kartu keluarga berhasil diperbarui');
    }

    // Hapus data
    public function delete($no_kk)
    {
        master_penduduk::where('no_kk', $no_kk)->delete();

        master_kartukeluarga::where('no_kk', $no_kk)->delete();

        return redirect(url('admin/master_kartukeluarga'))
            ->with('success', 'Data kartu keluarga berhasil dihapus');
    }
    public function import(Request $request)
{
    $import = new PendudukImport();

    Excel::import($import, $request->file('file'));

    $errors = $import->getErrors();

    if (count($errors) > 0) {
        return back()->with([
            'warning' => 'Import selesai, tetapi ada beberapa data yang gagal.',
            'import_errors' => $errors
        ]);
    }

    return back()->with('success', 'Semua data berhasil diimport.');
}

}