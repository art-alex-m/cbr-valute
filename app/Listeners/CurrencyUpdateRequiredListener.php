<?php

namespace App\Listeners;

use App\Events\CurrencyUpdateRequired;
use App\Services\CurrencyUpdateService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CurrencyUpdateRequiredListener implements ShouldQueue
{
    use InteractsWithQueue;

    protected CurrencyUpdateService $service;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CurrencyUpdateService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     *
     * @param App\Events\CurrencyUpdateRequired $event
     *
     * @return void
     */
    public function handle(CurrencyUpdateRequired $event)
    {
        $this->service->update($event->getDate());
    }
}
