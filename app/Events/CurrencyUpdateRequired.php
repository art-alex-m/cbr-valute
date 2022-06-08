<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CurrencyUpdateRequired
{
    use Dispatchable, SerializesModels;

    /** @var Carbon Дата курса */
    private Carbon $date;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Carbon $date)
    {
        $this->date = $date;
    }

    /**
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }
}
