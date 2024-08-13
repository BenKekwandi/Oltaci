<?php

namespace App\Enums;

enum UserTypeEnum: string
{
    case MEMBER = 'member';
    case ADMIN = 'admin';


    public function label(): string
    {
        return match ($this) {
            UserTypeEnum::MEMBER => 'member',
            UserTypeEnum::ADMIN => 'admin',
        };
    }

}
