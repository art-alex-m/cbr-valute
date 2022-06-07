<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Currency.
 *
 * @package App\Models
 *
 * @property int $id Идентификатор
 * @property Carbon $date Дата курса
 * @property string $char_code Код валюты
 * @property int $nominal Номинал
 * @property float $value Значение курса
 * @property Carbon $created_at Дата создания
 * @property Carbon $updated_at Дата обновления
 */
class Currency extends Model
{
    protected $casts = [
        'date' => Carbon::class,
    ];
}
