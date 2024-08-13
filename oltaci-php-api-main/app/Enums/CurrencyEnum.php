<?php

namespace App\Enums;

enum CurrencyEnum: string
{
    case USD = 'USD';
    case TRY = 'TRY';
    case GBP = 'GBP';
    case EUR = 'EUR';


    public function label(): string
    {
        return match ($this) {
            CurrencyEnum::USD => 'USD',
            CurrencyEnum::TRY => 'TRY',
            CurrencyEnum::GBP => 'GBP',
            CurrencyEnum::EUR => 'EUR',
        };
    }

}
