<?php

namespace App\Http\Controllers\API;

use App\Models\master_akun;
use App\Models\master_penduduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProfileControllerMobile extends Controller
{
    /**
     * Ambil profil gabungan (master_akun + master_penduduks) milik user yang login.
     * NIK diambil dari token Sanctum — tidak perlu dikirim di query param.
     */
    public function index(Request $request)
    {
        $nik = $request->user()->nik;

        $profil = DB::table('master_penduduks')
            ->leftJoin('master_akun', 'master_penduduks.nik', '=', 'master_akun.nik')
            ->select(
                'master_penduduks.no_kk',
                'master_penduduks.nik',
                'master_penduduks.nama_lengkap',
                'master_akun.no_hp',
                'master_akun.email',
                'master_akun.foto_profil',
            )
            ->where('master_penduduks.nik', $nik)
            ->first();

        if (!$profil) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data profil tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => [
                'no_kk'        => $profil->no_kk,
                'nik'          => $profil->nik,
                'nama_lengkap' => $profil->nama_lengkap,
                'no_hp'        => $profil->no_hp,
                'email'        => $profil->email,
                'foto_profil'  => $profil->foto_profil
                    ? asset('storage/foto_profil/' . $profil->foto_profil)
                    : asset('storage/foto_profil/default.jpg'),
            ],
        ]);
    }

    /**
     * Ambil data kependudukan lengkap milik user yang login.
     * NIK diambil dari token Sanctum — tidak perlu dikirim di query param.
     */
    public function getByNik(Request $request)
    {
        $nik = $request->user()->nik;

        $user = master_penduduk::where('nik', $nik)->first();

        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data kependudukan tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => [
                'nama'           => $user->nama_lengkap,
                'nik'            => $user->nik,
                'no_kk'          => $user->no_kk,
                'tempatLahir'    => $user->tempat_lahir,
                'tanggalLahir'   => $user->tanggal_lahir,
                'golDarah'       => $user->golongan_darah,
                'jk'             => $user->jenis_kelamin,
                'kewarganegaraan'=> $user->kewarganegaraan,
                'agama'          => $user->agama,
                'statusKeluarga' => $user->status_keluarga,
                'pekerjaan'      => $user->pekerjaan,
                'pendidikan'     => $user->pendidikan,
                'namaAyah'       => $user->nama_ayah,
                'namaIbu'        => $user->nama_ibu,
            ],
        ]);
    }

    /**
     * Update foto profil user yang sedang login.
     * NIK diambil dari token Sanctum — tidak bisa di-spoof via request body.
     */
    public function updateFoto(Request $request)
    {
        try {
            $request->validate([
                'foto_profil' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ], [
                'foto_profil.required' => 'File foto wajib diunggah.',
                'foto_profil.image'    => 'File harus berupa gambar.',
                'foto_profil.mimes'    => 'Format gambar harus JPG, JPEG, atau PNG.',
                'foto_profil.max'      => 'Ukuran foto maksimal 2MB.',
            ]);

            $nik  = $request->user()->nik;
            $user = master_akun::where('nik', $nik)->first();

            if (!$user) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Akun tidak ditemukan.',
                ], 404);
            }

            $file      = $request->file('foto_profil');
            $extension = $file->getClientOriginalExtension();
            $randomName = Str::random(40) . '.' . $extension;

            // Hapus foto lama jika ada (kecuali default)
            if ($user->foto_profil && $user->foto_profil !== 'default.jpg') {
                if (Storage::disk('public')->exists('foto_profil/' . $user->foto_profil)) {
                    Storage::disk('public')->delete('foto_profil/' . $user->foto_profil);
                }
            }

            // Simpan foto baru
            $file->storeAs('foto_profil', $randomName, 'public');

            $user->foto_profil = $randomName;
            $user->save();

            return response()->json([
                'status'      => 'success',
                'message'     => 'Foto profil berhasil diperbarui.',
                'foto_profil' => asset('storage/foto_profil/' . $randomName),
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => collect($e->errors())->flatten()->first(),
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update email dan/atau nomor HP user yang sedang login.
     * NIK diambil dari token Sanctum — tidak bisa di-spoof via request body.
     */
    public function updateEmailNoHp(Request $request)
    {
        try {
            $nik = $request->user()->nik;

            $request->validate([
                'email' => [
                    'nullable',
                    'email',
                    Rule::unique('master_akun', 'email')->ignore($nik, 'nik'),
                ],
                'no_hp' => [
                    'nullable',
                    'string',
                    'max:20',
                    Rule::unique('master_akun', 'no_hp')->ignore($nik, 'nik'),
                ],
            ], [
                'email.email'    => 'Format email tidak valid.',
                'email.unique'   => 'Email telah digunakan, gunakan yang lain.',
                'no_hp.max'      => 'No HP maksimal 20 karakter.',
                'no_hp.unique'   => 'No HP telah digunakan, gunakan yang lain.',
            ]);

            $user = master_akun::where('nik', $nik)->first();

            if (!$user) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Akun tidak ditemukan.',
                ], 404);
            }

            $updatedFields = [];

            if ($request->has('email') && $request->email !== $user->email) {
                $user->email     = $request->email;
                $updatedFields[] = 'email';
            }

            if ($request->has('no_hp') && $request->no_hp !== $user->no_hp) {
                $user->no_hp     = $request->no_hp;
                $updatedFields[] = 'no_hp';
            }

            if (empty($updatedFields)) {
                return response()->json([
                    'status'  => 'info',
                    'message' => 'Tidak ada data yang diubah.',
                ], 200);
            }

            $user->save();

            if (count($updatedFields) === 2) {
                $message = 'Email dan No HP berhasil diperbarui.';
            } elseif ($updatedFields[0] === 'email') {
                $message = 'Email berhasil diperbarui.';
            } else {
                $message = 'No HP berhasil diperbarui.';
            }

            return response()->json([
                'status'  => 'success',
                'message' => $message,
                'data'    => [
                    'email' => $user->email,
                    'no_hp' => $user->no_hp,
                ],
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => collect($e->errors())->flatten()->first(),
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}