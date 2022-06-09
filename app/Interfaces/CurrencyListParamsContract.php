<?php

namespace App\Interfaces;

use Carbon\CarbonInterface;

interface CurrencyListParamsContract
{
    /**
     * Код валюты для базовых отношений.
     *
     * @return string
     */
    public function getBase(): string;

    /**
     * Дата расчета курса валют.
     *
     * @return CarbonInterface
     */
    public function getDate(): CarbonInterface;
}
