<?php

namespace App\Services;



use Illuminate\Support\Facades\Http;



class BakongService
{


    protected $baseUrl;
    protected $token;


    public function __construct()
    {
        $this->baseUrl = config('services.bakong.api_url', env('BAKONG_API_URL'));
        $this->token = config('services.bakong.token', env('BAKONG_API_TOKEN'));
    }

    public function checkTransactionByMd5(string $md5)
    {
        $url = $this->baseUrl . '/check_transaction_by_md5';

        $payload = [
            'md5' => $md5,
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
            'Content-Type' => 'application/json',
        ])->post($url, $payload);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
