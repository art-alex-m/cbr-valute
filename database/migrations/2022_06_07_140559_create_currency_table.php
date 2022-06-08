<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->date('date')->index()->comment('Дата курса');
            $table->string('char_code', 4)->comment('Код валюты');
            $table->integer('nominal')->comment('Номинал');
            $table->double('value')->comment('Значение курса');
            $table->timestamps();

            $table->foreign('char_code')->on('currency_codes')->references('char_code')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['char_code', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
};
