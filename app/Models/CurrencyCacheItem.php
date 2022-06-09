<?php

namespace App\Models;

use App\Enums\DateFormatEnum;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Cache;

class CurrencyCacheItem
{
    protected string $base;
    protected CarbonInterface $date;
    /** @var int Время жизни кеша. */
    protected int $ttl = 60;

    /**
     * @param string $base
     * @param CarbonInterface $date
     */
    public function __construct(string $base, CarbonInterface $date)
    {
        $this->base = $base;
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->base . $this->date->format(DateFormatEnum::DB->value);
    }

    /**
     * @return array|null
     */
    public function get(): ?array
    {
        return Cache::get($this->getKey());
    }

    /**
     * @param array $data
     */
    public function set(array $data): void
    {
        if (empty($data)) {
            return;
        }

        Cache::put($this->getKey(), $data, $this->ttl);
    }

    /**
     * @return bool
     */
    public function exists(): bool
    {
        return Cache::has($this->getKey());
    }
}
