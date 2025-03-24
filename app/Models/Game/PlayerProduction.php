<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Repositories\ProductionRepository;

class PlayerProduction extends Model
{
    protected $fillable = [
        'player_id',
        'type_area',
        'coid',
        'start_build',
        'end_build',
        'player_character_id',
        'completed',
        'area',
        'degration',
        'water',
        'amount',
    ];

    protected $appends = ['game_data'];

    /**
     * Get the player that owns the production.
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function playerCharacter(): BelongsTo
    {
        return $this->belongsTo(PlayerCharacter::class);
    }

    public function getGameDataAttribute(): ?object
    {
        $repo = app(ProductionRepository::class);
        return $repo->find($this->coid);
    }
}
