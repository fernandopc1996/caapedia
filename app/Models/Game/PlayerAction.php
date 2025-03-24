<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerAction extends Model
{
    protected $fillable = [
        'player_id',
        'player_production_id',
        'player_character_id',
        'completed',
        'start',
        'end',
        'area',
        'degration',
        'water',
        'amount',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function playerCharacter(): BelongsTo
    {
        return $this->belongsTo(PlayerCharacter::class);
    }

    public function playerProduction(): BelongsTo
    {
        return $this->belongsTo(PlayerProduction::class);
    }
}
