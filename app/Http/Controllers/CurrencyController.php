<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyListRequest;
use App\Services\CurrencyCacheService;
use App\Services\CurrencyService;

class CurrencyController extends Controller
{
    protected CurrencyService $currencyService;
    protected CurrencyCacheService $cacheService;

    /**
     * @param CurrencyService $currencyService
     */
    public function __construct(CurrencyService $currencyService, CurrencyCacheService $cacheService)
    {
        $this->currencyService = $currencyService;
        $this->cacheService = $cacheService;
    }


    /**
     * Список курсов валют.
     *
     * @return array
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     *
     * @OA\Get(
     *     path="/currency/list",
     *     summary="Список курсов валют",
     *     operationId="showCurrencyList",
     *
     *     @OA\Parameter(
     *        name="base",
     *        in="query",
     *        description="Код базовой валюты",
     *        @OA\Schema(
     *           type="string",
     *           maxLength=3,
     *           minLength=3,
     *        ),
     *        example="USD",
     *     ),
     *
     *     @OA\Parameter(
     *        name="date",
     *        in="query",
     *        description="Дата курса",
     *        @OA\Schema(
     *            type="string",
     *            format="date",
     *        ),
     *        example="2022-06-08",
     *     ),
     *
     *     @OA\Response(
     *        response="200",
     *        description="Список курсов валют",
     *        @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CurrencyDto")),
     *     ),
     *     @OA\Response(response="422", description="Unprocessable Content"),
     * )
     */
    public function showList(CurrencyListRequest $request)
    {
        $cacheItem = $this->cacheService->getItem($request);

        if ($cacheItem->exists()) {
            return $cacheItem->get();
        }

        $data = $this->currencyService->getCurrencyList($request);
        $cacheItem->set($data);

        return $data;
    }
}
