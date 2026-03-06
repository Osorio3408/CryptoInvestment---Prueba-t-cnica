<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CoinMarketCapService
{
    public function getLatest()
    {
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => config('services.coinmarketcap.key')
        ])->get('https://sandbox-api.coinmarketcap.com/v1/cryptocurrency/listings/latest');

        return $response->json();
    }
}
