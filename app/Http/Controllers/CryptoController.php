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
        $cryptos = Cryptocurrency::limit(20)->get();

        return CryptocurrencyResource::collection($cryptos);
    }


public function history(int $id)
{
    $crypto = Cryptocurrency::find($id);

    if (!$crypto) {
        return response()->json([]);
    }

    $history = $crypto->priceHistories()
        ->orderByDesc('recorded_at')
        ->limit(50)
        ->get(['price','recorded_at']);

    return response()->json(
        $history->map(fn($item) => [
            'timestamp' => $item->recorded_at->toDateTimeString(),
            'price' => (float) $item->price
        ])
    );
}
}
