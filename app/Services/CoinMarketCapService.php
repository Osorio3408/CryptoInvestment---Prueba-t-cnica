<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CoinMarketCapService
{
    public function getLatest(): array
    {
        return Cache::remember('cmc_latest_prices', 60, function () {

            try {

                $response = Http::withHeaders([
                    'X-CMC_PRO_API_KEY' => config('services.coinmarketcap.key'),
                ])->get('https://sandbox-api.coinmarketcap.com/v1/cryptocurrency/listings/latest');
            } catch (\Exception $e) {

                Log::error('CoinMarketCap connection failed', [
                    'message' => $e->getMessage()
                ]);

                return [];
            }
            if (!$response->successful()) {
                Log::error('CoinMarketCap API error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return [];
            }

            return $response->json();
        });
    }
}
