<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nickname', 
        'mode_time',
        'last_datetime',
        'last_execution',
        'area',
        'degration',
        'water',
        'amount',
    ];

    /**
     * Get all productions related to the player.
     */
    public function playerProductions(): HasMany
    {
        return $this->hasMany(PlayerProduction::class);
    }

    public function playerCharacters(): HasMany
    {
        return $this->hasMany(PlayerCharacter::class);
    }

    /**
     * Get all actions related to the player.
     */
    public function playerActions(): HasMany
    {
        return $this->hasMany(PlayerAction::class);
    }

    /**
     * Get all products related to the player.
     */
    public function playerProducts(): HasMany
    {
        return $this->hasMany(PlayerProduct::class);
    }
}