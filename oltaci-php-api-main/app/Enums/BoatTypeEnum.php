<?php

namespace App\Enums;

enum BoatTypeEnum: string
{
    case FISHING = 'fishing';
    case TOUR = 'tour';


    public function label(): string
    {
        return match ($this) {
            BoatTypeEnum::FISHING => 'fishing',
            BoatTypeEnum::TOUR => 'tour',
        };
    }

}
