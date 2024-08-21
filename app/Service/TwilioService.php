<?php

namespace App\Service;

use Twilio\Rest\Client;
use GuzzleHttp\Client as HttpClient;

class TwilioService
{
    protected $twilio;
    protected $authyApiKey;
    protected $httpClient;

    public function __construct()
    {
        $this->twilio      = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
        $this->authyApiKey = env('TWILIO_AUTHY_API_KEY');
        $this->httpClient  = new HttpClient();
    }

    // Đăng ký người dùng với Authy
    public function registerUser($email, $phone, $countryCode)
    {
        try {
            $response = $this->httpClient->post(
                'https://api.authy.com/protected/json/users/new', [
                'form_params' => [
                    'user[email]'        => $email,
                    'user[cellphone]'    => $phone,
                    'user[country_code]' => $countryCode,
                ],

                'headers' => [
                    'X-Authy-API-Key' => $this->authyApiKey,
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $exception) {
            return ['success' => false, 'messages' => "Register User Twilio error: {$exception->getMessage()}"];
        }
    }

    // Gửi mã OTP
    public function sendToken($authyId)
    {
        try {
            $response = $this->httpClient->post('https://api.authy.com/protected/json/sms/' . $authyId, [
                'headers' => [
                    'X-Authy-API-Key' => $this->authyApiKey,
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $exception) {
            return ['success' => false, 'messages' => "Send Token Twilio error: {$exception->getMessage()}"];
        }
    }

    // Xác thực mã OTP
    public function verifyToken($authyId, $token)
    {
        try {
            $response = $this->httpClient->get('https://api.authy.com/protected/json/verify/' . $token . '/' . $authyId, [
                'headers' => [
                    'X-Authy-API-Key' => $this->authyApiKey,
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $exception) {
            return ['success' => false, 'messages' => "Verify Token Twilio error: {$exception->getMessage()}"];
        }
    }
}
