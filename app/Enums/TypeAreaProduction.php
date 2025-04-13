<?php

namespace App\Enums;

enum TypeAreaProduction: int
{
    case Breeding = 1; 
    case Cultivation = 2;   
    case Manufacturing = 3;   

    public function label(): string
    {
        return match ($this) {
            self::Breeding       => 'Criação',
            self::Cultivation    => 'Cultivo',
            self::Manufacturing  => 'Manufatura',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Breeding => 'Área destinada à criação de animais como aves, caprinos, bovinos e outras espécies animais.',
            self::Cultivation => 'Área voltada para o cultivo de frutas, grãos, hortaliças, raízes, plantas medicinais e outras espécies vegetais.',
            self::Manufacturing => 'Espaço para transformação de matérias-primas em produtos como queijos, couro tratado, utensílios e outros itens manufaturados.',
        };
    }
}
