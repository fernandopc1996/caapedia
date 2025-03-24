<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerProduct extends Model
{
    protected $fillable = [
        'player_id',
        'coid',
        'player_action_id',
        'player_production_id',
        'op',
        'amount',
    ];

    /**
     * Get the player that owns the product.
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * Get the related action that generated the product.
     */
    public function playerAction(): BelongsTo
    {
        return $this->belongsTo(PlayerAction::class);
    }

    /**
     * Get the related production that generated the product.
     */
    public function playerProduction(): BelongsTo
    {
        return $this->belongsTo(PlayerProduction::class);
    }
}
