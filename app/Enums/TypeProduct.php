<?php

namespace App\Enums;

enum TypeProduct: int
{
    case ANIMALS = 1;
    case SEEDLINGS_AND_SEEDS = 2;
    case PLANT_BASED_PRODUCTS = 3;
    case ANIMAL_BASED_PRODUCTS = 4;
    case FERTILIZERS_AND_PESTICIDES = 5;
    case PROCESSED_PRODUCTS = 6;
    case HANDCRAFTED_ITEMS = 7;
    case NATURAL_REMEDIES = 8;

    public function label(): string
    {
        return match ($this) {
            self::ANIMALS => 'Animais',
            self::SEEDLINGS_AND_SEEDS => 'Mudas e Sementes',
            self::PLANT_BASED_PRODUCTS => 'Produtos de origem vegetal',
            self::ANIMAL_BASED_PRODUCTS => 'Produtos de origem animal',
            self::FERTILIZERS_AND_PESTICIDES => 'Fertilizantes / Agrotóxicos',
            self::PROCESSED_PRODUCTS => 'Produtos processados',
            self::HANDCRAFTED_ITEMS => 'Artesanato / Utensílios',
            self::NATURAL_REMEDIES => 'Remédios naturais',
        };
    }
}
