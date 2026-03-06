<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\CoinMarketCapService;

class CryptoController extends Controller
{
    public function index(CoinMarketCapService $service): JsonResponse
    {
        return response()->json(
            $service->getLatest()
        );
    }
}