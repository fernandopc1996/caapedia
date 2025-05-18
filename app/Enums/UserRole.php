<?php

namespace App\Enums;

enum UserRole: int
{
    case Player = 1;
    case Moderator = 5;
    case Administrator = 9;

    public function label(): string
    {
        return match ($this) {
            self::Player => 'Jogador',
            self::Moderator => 'Moderador',
            self::Administrator => 'Administrador',
        };
    }

    public function isAdmin(): bool
    {
        return $this === self::Administrator;
    }
}