<?php

namespace App\Http\Controllers;

class CurrencyController extends Controller
{
    /**
     * Список курсов валют.
     *
     * @return array
     *
     * @OA\Get(
     *     path="/currency/list",
     *     summary="Список курсов валют",
     *     operationId="showCurrencyList",
     *
     *     @OA\Response(
     *        response="200",
     *        description="Список курсов валют",
     *        @OA\JsonContent(ref="#/components/schemas/CurrencyDto"),
     *     ),
     *     @OA\Response(response="422", description="Unprocessable Content"),
     * )
     */
    public function showList()
    {
        return [];
    }
}
