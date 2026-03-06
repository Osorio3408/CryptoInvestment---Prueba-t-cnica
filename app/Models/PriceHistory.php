<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $cryptocurrency_id
 * @property float $price
 * @property float $percent_change_24h
 * @property float $volume_24h
 * @property \Carbon\Carbon $recorded_at
 */
class PriceHistory extends Model
{
    protected $fillable = [
        'cryptocurrency_id',
        'price',
        'percent_change_24h',
        'volume_24h',
        'recorded_at'
    ];
    protected $casts = [
    'recorded_at' => 'datetime'
];

    public function cryptocurrency()
    {
        return $this->belongsTo(Cryptocurrency::class);
    }
}
