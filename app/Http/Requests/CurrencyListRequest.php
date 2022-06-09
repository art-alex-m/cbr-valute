<?php

namespace App\Http\Requests;

use App\Enums\DateFormatEnum;
use App\Interfaces\CurrencyListParamsContract;
use App\Models\CurrencyCode;
use Carbon\CarbonInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class CurrencyListRequest extends FormRequest implements CurrencyListParamsContract
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'date' => 'string|date:' . DateFormatEnum::DB->value,
            'base' => 'string|exists:App\Models\CurrencyCode,char_code',
        ];
    }

    public function getBase(): string
    {
        return $this->get('base', CurrencyCode::DEFAULT_BASE);
    }

    public function getDate(): CarbonInterface
    {
        $format = DateFormatEnum::DB->value;

        return Carbon::createFromFormat($format, $this->get('date', date($format)));
    }
}
