<?php

namespace App\Services;


use App\Interfaces\CurrencyListParamsContract;
use App\Models\CurrencyCacheItem;

class CurrencyCacheService
{
    /**
     * Создает экземпляр кеша по указанным параметрам.
     *
     * @param CurrencyListParamsContract $params
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getItem(CurrencyListParamsContract $params): CurrencyCacheItem
    {
        return app()->make(CurrencyCacheItem::class, [
            'base' => $params->getBase(),
            'date' => $params->getDate()
        ]);
    }
}
