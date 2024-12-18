<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

if (!function_exists('LogError')) {
    function LogError($action, $messages, $line, $file)
    {
        Log::error("API File : {$file}, Action : {$action}, Line : {$line}, Error : {$messages}");
    }
}

if (!function_exists('findFirstValueArray')) {
    function findFirstValueArray($arrays, $key_search, $value_search)
    {
        if (empty($arrays) || empty($key_search) || empty($value_search)) return [];

        $result = array_filter($arrays, function($item) use ($key_search, $value_search) {
            return $item[$key_search] == $value_search;
        });

        return $result ? $result : [];
    }
}

if (!function_exists('verifyReCaptcha')) {
    function verifyReCaptcha($token)
    {
        $secretKey = env('RECAPTCHA_SECRET_KEY');

        if (empty($token) || empty($secretKey)) return false;

        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => $secretKey,
                'response' => $token,
            ]);
    
            $data = $response->json();
    
            if ($data['success'] && $data['score'] > 0.5) {
                return true;
            }
    
            return false;
        } catch (\Exception $exeption) {
            Log::error("Error : {$exeption->getMessage()}");

            return false;
        }
    }
}
