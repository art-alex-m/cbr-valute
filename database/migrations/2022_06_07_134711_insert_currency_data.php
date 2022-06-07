<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [
            ['char_code' => 'RUB', 'name' => 'Российский рубль'],
            ['char_code' => 'USD', 'name' => 'Доллар США'],
            ['char_code' => 'EUR', 'name' => 'Евро'],
            ['char_code' => 'JPY', 'name' => 'Японская иена'],
            ['char_code' => 'CNY', 'name' => 'Китайская юань'],
        ];

        DB::table('currency_codes')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
