<?php

namespace App\Http\Controllers\SekretarisDesa;

use App\Http\Controllers\Controller;
use App\Models\master_penduduk;
use Illuminate\Http\Request;

class SekdesPendudukController extends Controller
{
    public function index(Request $request)
    {
        $no_kk = $request->nokk;

        $query = master_penduduk::query();

        if (!empty($no_kk)) {
            $query->where('no_kk', $no_kk);
        }

        if (!empty($request->katakunci)) {
            $query->where(function ($q) use ($request) {
                $q->where('nik', 'LIKE', '%' . $request->katakunci . '%')
                  ->orWhere('nama_lengkap', 'LIKE', '%' . $request->katakunci . '%');
            });
        }

        $query->orderBy('no_kk')
              ->orderByRaw("FIELD(status_keluarga, 'Kepala Keluarga', 'KEPALA KELUARGA', 'Suami', 'Istri', 'Anak')");

        $master_penduduk = $query->paginate(10);

        return view('sekretarisdesa.master_penduduk.index', compact('master_penduduk', 'no_kk'));
    }

    public function masuk(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16|numeric|unique:master_penduduks,nik',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required',
            'status_keluarga' => 'required',
            'no_kk' => 'required|exists:master_kartukeluargas,no_kk',
        ], [
            'nik.required' => 'NIK wajib diisi',
            'nik.digits' => 'NIK harus 16 digit',
            'nik.unique' => 'NIK sudah digunakan',
            'no_kk.required' => 'Nomor KK wajib diisi',
            'no_kk.exists' => 'Nomor KK tidak ditemukan dalam database',
        ]);

        master_penduduk::create($request->all());

        return redirect()->to('sekretarisdesa/penduduk?nokk=' . $request->no_kk)
            ->with('success', 'Anggota keluarga berhasil ditambahkan.');
    }

    public function update(Request $request, $nik_lama)
    {
        $pendudukLama = master_penduduk::where('nik', $nik_lama)->first();

        if (!$pendudukLama) {
            return redirect()->back()->with('error', 'Data penduduk tidak ditemukan.');
        }

        $request->validate([
            'nik' => 'required|digits:16|unique:master_penduduks,nik,' . $pendudukLama->nik . ',nik',
            'nama_lengkap' => 'required',
        ]);

        $no_kk = $pendudukLama->no_kk;

        $pendudukLama->update($request->except(['_token', '_method']));

        return redirect()->to('sekretarisdesa/penduduk?nokk=' . $no_kk)->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function delete($nik)
    {
        $penduduk = master_penduduk::where('nik', $nik)->first();

        if (!$penduduk) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $no_kk = $penduduk->no_kk;
        $penduduk->delete();

        return redirect()->to('sekretarisdesa/penduduk?nokk=' . $no_kk)->with('success', 'Data penduduk berhasil dihapus.');
    }
}
