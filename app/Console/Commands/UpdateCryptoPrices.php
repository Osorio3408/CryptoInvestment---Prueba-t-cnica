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
            return Command::FAILURE;
        }

        foreach (array_slice($data['data'], 0, 20) as $crypto) {

            // Validar que exista el quote USD
            if (!isset($crypto['quote']['USD'])) {
                continue;
            }

            $quote = $crypto['quote']['USD'] ?? null;

            if (!$quote) {
                continue;
            }


            $price = $crypto['quote']['USD']['price'] ?? 0;
            $percentChange = $crypto['quote']['USD']['percent_change_24h'] ?? 0;
            $volume = $crypto['quote']['USD']['volume_24h'] ?? 0;

$cryptocurrency = Cryptocurrency::updateOrCreate(
    ['cmc_id' => $crypto['id']],
    [
        'name' => $crypto['name'],
        'symbol' => $crypto['symbol'],
        'price' => (float) $price,
        'percent_change_24h' => (float) $percentChange
    ]
);

            $cryptocurrency->update([
                'price' => $price,
                'percent_change_24h' => $percentChange
            ]);

            PriceHistory::create([
                'cryptocurrency_id' => $cryptocurrency->id,
                'price' => $price,
                'percent_change_24h' => $percentChange,
                'volume_24h' => $volume,
                'recorded_at' => now()
            ]);
        }

        $this->info('Crypto prices updated successfully');

        return Command::SUCCESS;
    }
}
