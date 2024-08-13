<?php

namespace App\Enums;

enum PaymentMethodEnum: string
{
    case CASH = 'cash';
    case CARD = 'card';


    public function label(): string
    {
        return match ($this) {
            PaymentMethodEnum::CASH => 'cash',
            PaymentMethodEnum::CARD => 'card',
        };
    }

}
