<?php

namespace App\Http\Dto;

use DateTime;
use Spatie\DataTransferObject\DataTransferObject;

/**
 * Class CurrencyDto.
 *
 * @package App\Http\Dto
 *
 * @OA\Schema(
 *     schema="CurrencyDto",
 *     description="Информация о курсе валюты",
 * )
 */
class CurrencyDto extends DataTransferObject
{
    /**
     * @var string Код валюты.
     * @OA\Property(example="USD")
     */
    public string $charCode;

    /**
     * @var DateTime Дата курса.
     * @OA\Property(type="string", format="date")
     */
    public DateTime $date;

    /**
     * @var int Номинал.
     * @OA\Property(example=1)
     */
    public int $nominal;

    /**
     * @var float Значение курса.
     * @OA\Property(example=30.9436)
     */
    public float $value;

    /**
     * @var float Отношение к базовому курсу.
     * @OA\Property(example=30.9436)
     */
    public float $diffBase;

    /**
     * @var float Разница с предыдущим днем.
     * @OA\Property(example=-2.0436)
     */
    public float $diffYesterday;
}
