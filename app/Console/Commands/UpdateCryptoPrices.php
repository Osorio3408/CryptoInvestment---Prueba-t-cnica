<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CoinMarketCapService;
use App\Models\Cryptocurrency;
use App\Models\PriceHistory;

class UpdateCryptoPrices extends Command
{
    protected $signature = 'crypto:update-prices';
    protected $description = 'Fetch latest crypto prices and store them';

    public function handle(CoinMarketCapService $service)
    {
        $data = $service->getLatest();

        if (!isset($data['data'])) {
            $this->error('Invalid API response');
            return;
        }

        foreach ($data['data'] as $crypto) {

            $cryptocurrency = Cryptocurrency::firstOrCreate(
                ['cmc_id' => $crypto['id']],
                [
                    'name' => $crypto['name'],
                    'symbol' => $crypto['symbol']
                ]
            );

            PriceHistory::create([
                'cryptocurrency_id' => $cryptocurrency->id,
                'price' => $crypto['quote']['USD']['price'],
                'percent_change_24h' => $crypto['quote']['USD']['percent_change_24h'],
                'volume_24h' => $crypto['quote']['USD']['volume_24h'],
                'recorded_at' => now()
            ]);
        }

        $this->info('Crypto prices updated successfully');
    }
}