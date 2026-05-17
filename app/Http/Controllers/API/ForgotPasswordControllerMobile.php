<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\master_akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class ForgotPasswordControllerMobile extends Controller
{
    public function sendResetOtpWhatsApp(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $request->validate([
                'no_hp' => ['required', 'exists:master_akun,no_hp'],
            ]);

            $akun = master_akun::where('no_hp', $request->no_hp)->first();

            if (!$akun) {
                return response()->json([
                    'message' => 'Nomor HP tidak terdaftar.',
                    'status' => 404
                ], 404);
            }

            $otp = rand(100000, 999999);
            $expiresAt = now()->addMinutes(10);

            DB::table('password_resets')->updateOrInsert(
                ['no_hp' => $request->no_hp],
                [
                    'otp' => $otp,
                    'expired_at' => $expiresAt,
                    'is_used' => false,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );

            $target = $this->formatNoHp($request->no_hp);

            $message = "Kode OTP reset password Anda adalah: $otp. Kode ini berlaku selama 10 menit. Jangan berikan kode ini kepada siapa pun.";

            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_TOKEN'),
            ])->asForm()->post('https://api.fonnte.com/send', [
                'target' => $target,
                'message' => $message,
            ]);

            return response()->json([
                'message' => 'Debug kirim OTP',
                'target' => $target,
                'fonnte_status_code' => $response->status(),
                'fonnte_response' => $response->json(),
                'raw_response' => $response->body(),
                'status' => 200
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Nomor HP tidak terdaftar.',
                'errors' => $e->errors(),
                'status' => 422
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    private function formatNoHp($no_hp)
    {
        $no_hp = preg_replace('/[^0-9]/', '', $no_hp);

        if (substr($no_hp, 0, 1) === '0') {
            $no_hp = '62' . substr($no_hp, 1);
        }

        return $no_hp;
    }
}