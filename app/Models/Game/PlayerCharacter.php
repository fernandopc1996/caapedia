<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\CharacterRepository;

class PlayerCharacter extends Model
{
    protected $fillable = [
        'player_id',
        'coid',
        'working',
    ];

    protected $appends = ['game_data'];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function getGameDataAttribute(): ?object
    {
        $repo = app(CharacterRepository::class);
        return $repo->find($this->coid);
    }
}
