<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CurrencyCode.
 *
 * @package App\Models
 *
 * @property string $char_code
 * @property string $name
 * @property boolean $active
 */
class CurrencyCode extends Model
{
    public const DEFAULT_BASE = 'RUB';

    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = 'char_code';
    protected $keyType = 'string';

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', '=', true);
    }
}
