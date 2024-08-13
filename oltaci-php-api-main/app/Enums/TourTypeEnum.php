<?php

namespace App\Enums;

enum TourTypeEnum: string
{
    case INDIVIDUAL = 'individual';
    case GROUP = 'group';
    case VIP = 'vip';


    public function label(): string
    {
        return match ($this) {
            TourTypeEnum::INDIVIDUAL => 'individual',
            TourTypeEnum::GROUP => 'group',
            TourTypeEnum::VIP => 'vip',
        };
    }

}
