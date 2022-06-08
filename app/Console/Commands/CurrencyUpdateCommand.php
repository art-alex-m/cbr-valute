<?php

namespace App\Console\Commands;

use App\Events\CurrencyUpdateRequired;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CurrencyUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update {date? : Date of the currency exchange rate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency exchange rate';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $dateArg = $this->argument('date');

        $date = $dateArg ? Carbon::createFromTimestamp(strtotime($dateArg)) : now();

        CurrencyUpdateRequired::dispatch($date);

        return 0;
    }
}
