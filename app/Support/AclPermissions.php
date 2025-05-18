<?php

namespace App\Support;

use App\Enums\UserRole;

class AclPermissions
{
    protected const PERMISSIONS = [
        UserRole::Player->value => [
            'play_game',
            'view_own_profile',
        ],

        UserRole::Moderator->value => [
            'play_game',
            'view_own_profile',
            'view_all_players',
            'suspend_player',
        ],

        UserRole::Administrator->value => [ 
            'play_game',
            'view_own_profile',
            'view_all_players',
            'suspend_player',
            'ban_player',
            'manage_users',
            'access_admin_panel',
            'manage_events',
        ],
    ];

    public static function permissions(UserRole $role): array
    {
        return self::PERMISSIONS[$role->value] ?? [];
    }

    public static function hasPermission(UserRole $role, string $permission): bool
    {
        if ($role === UserRole::Administrator) {
            return true; 
        }

        return in_array($permission, self::permissions($role));
    }
}