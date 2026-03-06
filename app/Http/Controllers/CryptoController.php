<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\CoinMarketCapService;
use App\Models\Cryptocurrency;
use App\Http\Resources\CryptocurrencyResource;


class CryptoController extends Controller
{
    public function index()
    {
        $cryptos = Cryptocurrency::all();

        return CryptocurrencyResource::collection($cryptos);
    }


public function history(string $symbol)
{
    $symbol = strtoupper($symbol);

    if (!preg_match('/^[A-Z0-9]+$/', $symbol)) {
        return response()->json([
            'error' => 'Invalid cryptocurrency symbol'
        ], 422);
    }

    $crypto = Cryptocurrency::where('symbol', $symbol)->firstOrFail();

    $history = $crypto->priceHistories()
        ->orderBy('recorded_at')
        ->limit(50)
        ->get(['price', 'recorded_at']);

    return response()->json($history);
}
}
