<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Game\Player;
use App\Enums\UserRole;
use App\Support\AclPermissions;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'google_email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    public function players(): HasMany
    {
        return $this->hasMany(Player::class, 'user_id', 'id');
    }

    public function getRoleEnum(): UserRole
    {
        return $this->role; // já retorna como enum pelo cast
    }

    public function hasPermission(string $permission): bool
    {
        return AclPermissions::hasPermission($this->getRoleEnum(), $permission);
    }

    public function isAdmin(): bool
    {
        return $this->getRoleEnum() === UserRole::Administrator;
    }
}