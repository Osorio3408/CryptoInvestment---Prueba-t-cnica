<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\CoinMarketCapService;
use App\Models\Cryptocurrency;

class CryptoController extends Controller
{
    public function index(CoinMarketCapService $service): JsonResponse
    {
        return response()->json(
            $service->getLatest()
        );
    }


    public function history(string $symbol): JsonResponse
    {
        $crypto = Cryptocurrency::whereRaw('LOWER(symbol) = ?', [strtolower($symbol)])->firstOrFail();
        
        $history = $crypto->priceHistories()
            ->orderBy('recorded_at')
            ->limit(100)
            ->get(['price', 'recorded_at']);

        return response()->json(
            $history->map(function ($item) {
                return [
                    'timestamp' => $item->recorded_at,
                    'price' => $item->price
                ];
            })
        );
    }
}
