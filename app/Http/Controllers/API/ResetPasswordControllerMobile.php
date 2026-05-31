<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\master_akun;

class ResetPasswordControllerMobile extends Controller
{
    public function verify(Request $request)
    {
        try {
            $request->validate([
                'no_hp' => 'required|exists:master_akun,no_hp',
                'otp' => 'required|digits:6',
            ]);

            $resetRecord = DB::table('password_resets')
                ->where('no_hp', $request->no_hp)
                ->where('otp', $request->otp)
                ->where('is_used', false)
                ->latest()
                ->first();

            if (!$resetRecord) {
                return response()->json([
                    'status' => 422,
                    'message' => 'OTP tidak valid.',
                ], 422);
            }

            if (now()->gt($resetRecord->expired_at)) {
                return response()->json([
                    'status' => 422,
                    'message' => 'OTP telah kedaluwarsa.',
                ], 422);
            }

            return response()->json([
                'status' => 200,
                'message' => 'OTP valid.',
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 422,
                'message' => 'Data tidak valid.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function reset(Request $request)
{
    try {
        $request->validate([
            'no_hp' => 'required|exists:master_akun,no_hp',
            'otp' => 'required|digits:6',
            'password' => [
                'required',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/'
            ],
        ], [
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
            'password.regex' => 'Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka.',
        ]);

        $resetRecord = DB::table('password_resets')
            ->where('no_hp', $request->no_hp)
            ->where('otp', $request->otp)
            ->where('is_used', false)
            ->latest()
            ->first();

        if (!$resetRecord) {
            return response()->json([
                'status' => 422,
                'message' => 'OTP tidak valid.',
            ], 422);
        }

        if (now()->gt($resetRecord->expired_at)) {
            return response()->json([
                'status' => 422,
                'message' => 'OTP telah kedaluwarsa.',
            ], 422);
        }

        $user = master_akun::where('no_hp', $request->no_hp)->first();

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Nomor HP tidak ditemukan.',
            ], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')
            ->where('no_hp', $request->no_hp)
            ->where('otp', $request->otp)
            ->update([
                'is_used' => true,
                'updated_at' => now(),
            ]);

        return response()->json([
            'status' => 200,
            'message' => 'Password berhasil direset.',
        ], 200);

    } catch (ValidationException $e) {
        return response()->json([
            'status' => 422,
            'message' => 'Data tidak valid.',
            'errors' => $e->errors(),
        ], 422);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 500,
            'message' => $e->getMessage(),
        ], 500);
    }
}
}