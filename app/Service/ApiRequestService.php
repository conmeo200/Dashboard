<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Log;

class ApiRequestService
{

    public function send(string $url, string $method = 'GET', int $maxRetries = 3, array $data = [], array $headers = [], int $timeout = 5, int $retryDelay = 2000)
    {
        $method = strtoupper($method);

        try {
            $response = Http::withHeaders($headers)
                ->timeout($timeout)
                ->retry($maxRetries, $retryDelay)
                ->{$method}($url, $data);

            Log::info("Send API", [
                'url'      => $url,
                'method'   => $method,
                'headers'  => $headers,
                'data'     => $data,
                'status'   => $response->status(),
                'response' => $response->json(),
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'status'  => $response->status(),
                    'data'    => $response->json(),
                ];
            }

            return [
                'success' => false,
                'status'  => $response->status(),
                'error'   => $response->body(),
            ];
        } catch (\Exception $e) {
            Log::error("Send API Failed", [
                'url'     => $url,
                'method'  => $method,
                'headers' => $headers,
                'data'    => $data,
                'error'   => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'status'  => 0,
                'error'   => $e->getMessage(),
            ];
        }
    }
}
