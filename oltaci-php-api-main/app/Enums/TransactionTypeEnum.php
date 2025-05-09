<?php

namespace App\Enums;

enum TransactionTypeEnum: string
{
    case INCOME = 'income';
    case EXPENSE = 'expense';


    public function label(): string
    {
        return match ($this) {
            TransactionTypeEnum::INCOME => 'income',
            TransactionTypeEnum::EXPENSE => 'expense',
        };
    }

}
