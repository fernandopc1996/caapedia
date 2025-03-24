<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerProduction extends Model
{
    protected $fillable = [
        'player_id',
        'type_area',
        'coid',
        'start_build',
        'end_build',
        'area',
        'degration',
        'water',
        'amount',
    ];

    /**
     * Get the player that owns the production.
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}
