<?php

namespace Tests\Feature\Http\Controllers;

use App\Enums\DateFormatEnum;
use Symfony\Component\VarDumper\VarDumper;
use Tests\TestCase;

class CurrencyControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCurrencyListSuccessfull(): void
    {
        $response = $this->call('GET', '/api/currency/list', [
            'base' => 'USD',
            'date' => date(DateFormatEnum::DB->value)
        ]);

        $response->assertStatus(200);
        VarDumper::dump($response->getContent());
        $response->assertJsonStructure([
            '*' => [
                'charCode',
                'date',
                'nominal',
                'value',
                'diffBase',
                'diffYesterday',
            ]
        ]);
    }
}
