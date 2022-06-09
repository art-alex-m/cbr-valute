<?php

namespace App\Models;

use App\Enums\DateFormatEnum;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'date' => 'datetime:Y-m-d',
    ];

    protected $fillable = [
        'date',
    ];

    public function currencyCode(): BelongsTo
    {
        return $this->belongsTo(CurrencyCode::class, 'char_code', 'char_code');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->with('currencyCode', fn($q) => $q->active());
    }

    public function scopeDate(Builder $query, CarbonInterface $date): Builder
    {
        return $query->where('date', '=', $date->format(DateFormatEnum::DB->value));
    }

    public function scopeCharCode(Builder $query, string $code): Builder
    {
        return $query->where('char_code', '=', $code);
    }
}
