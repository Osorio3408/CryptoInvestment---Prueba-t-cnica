<?php

use App\Http\Controllers\CryptoController;
use Illuminate\Support\Facades\Route;

Route::get('/cryptos', [CryptoController::class, 'index']);
Route::get('/cryptos/{symbol}/history', [CryptoController::class, 'history']);