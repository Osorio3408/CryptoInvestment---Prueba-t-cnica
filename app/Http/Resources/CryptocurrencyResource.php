<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CryptocurrencyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'symbol' => $this->symbol,
            'price' => $this->latest_price,
            'percent_change_24h' => $this->percent_change_24h,
        ];
    }
}