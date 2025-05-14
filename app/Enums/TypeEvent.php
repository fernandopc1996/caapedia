<?php

namespace App\Enums;

enum TypeEvent: int
{
    case Monthly = 1;
    case Yearly = 2;
    case Random = 3;

    public function label(): string
    {
        return match ($this) {
            self::Monthly => 'Evento Mensal',
            self::Yearly  => 'Evento Anual',
            self::Random  => 'Evento Aleatório',
        };
    }
}
