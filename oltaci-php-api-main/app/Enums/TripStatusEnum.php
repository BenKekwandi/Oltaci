<?php

namespace App\Enums;

enum TripStatusEnum: string
{
    case SCHEDULED  = 'scheduled';
    case ONGOING  = 'ongoing';
    case COMPLETED  = 'completed';


    public function label(): string
    {
        return match ($this) {
            TripStatusEnum::SCHEDULED => 'scheduled',
            TripStatusEnum::ONGOING => 'ongoing',
            TripStatusEnum::COMPLETED => 'completed',
        };
    }

}
