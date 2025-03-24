<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerAction extends Model
{
    protected $fillable = [
        'player_id',
        'player_production_id',
        'start',
        'end',
        'area',
        'degration',
        'water',
        'amount',
    ];

    /**
     * Get the player that owns the action.
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * Get the related player production.
     */
    public function playerProduction(): BelongsTo
    {
        return $this->belongsTo(PlayerProduction::class);
    }
}
