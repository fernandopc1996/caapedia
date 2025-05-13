<?php

namespace App\Enums;

enum TypeFinance: int
{
    case COSTS = 1;
    case LOAN = 2;

    public function label(): string
    {
        return match ($this) {
            self::COSTS => 'Custos',
            self::LOAN => 'Empréstimo',
        };
    }
}
