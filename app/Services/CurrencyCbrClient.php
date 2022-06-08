<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class CurrencyCbrClient
{
    protected const DATE_FORMAT = 'd/m/Y';

    protected string $url = 'https://www.cbr.ru/scripts/XML_daily.asp';

    /**
     * Возвращает список курсов валют.
     *
     * @param Carbon $date
     *
     * @return Collection
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getList(Carbon $date): Collection
    {
        $responce = Http::retry(5, 500)->get($this->url, ['date_req' => $date->format(self::DATE_FORMAT)]);
        $responce->throw();

        $xml = simplexml_load_string($responce->body());
        $json = json_encode($xml);
        $data = json_decode($json);

        $collection = collect($data);

        return $collection;
    }
}
