<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class otpcontroller extends Controller
{
    public function sendOtp(): bool
    {
        Log::info('OTP: start sending');

        $email = "ahmedsamir11711@gmail.com";
        $otp   = 1541;

        Log::info('OTP: data prepared', [
            'email' => $email,
            'otp'   => $otp,
        ]);

        $emailData = [
            'personalizations' => [[
                'to' => [['email' => $email]],
                'subject' => 'OTP Verification'
            ]],
            'from' => [
                'email' => 'info@regtai.com'
            ],
            'content' => [[
                'type' => 'text/plain',
                'value' => "Your OTP code is: {$otp}"
            ]]
        ];

        Log::info('OTP: payload ready', $emailData);

        $ch = curl_init('https://api.sendgrid.com/v3/mail/send');

        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($emailData),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => [
                'Authorization: Bearer ' . 'XvcygejSX4SnlOcZgmZJ0oO1OQp1ZW1L',
                'Content-Type: application/json',
            ],
        ]);

        Log::info('OTP: curl request initialized');

        $response = curl_exec($ch);

        if ($response === false) {
            Log::error('OTP: curl_exec failed', [
                'error' => curl_error($ch),
            ]);
            curl_close($ch);
            return false;
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        Log::info('OTP: response received', [
            'http_code' => $httpCode,
            'response'  => $response,
        ]);

        curl_close($ch);

        if ($httpCode !== 202) {
            Log::error('OTP: email not accepted by SendGrid', [
                'http_code' => $httpCode,
                'response'  => $response,
            ]);
            return false;
        }

        Log::info('OTP: email sent successfully');

        return true;
    }
}
