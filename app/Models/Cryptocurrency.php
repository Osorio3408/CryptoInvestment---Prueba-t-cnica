<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cryptocurrency extends Model
{
    protected $fillable = [
        'name',
        'symbol',
        'cmc_id',
        'price',
        'percent_change_24h'
    ];

     protected $casts = [
        'price' => 'float',
        'percent_change_24h' => 'float'
    ];


    public function priceHistories()
    {
        return $this->hasMany(PriceHistory::class);
    }
}
