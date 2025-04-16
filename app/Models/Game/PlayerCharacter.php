<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Repositories\CharacterRepository;
use Illuminate\Support\Str;

class PlayerCharacter extends Model
{
    protected $fillable = [
        'player_id',
        'coid',
        'working',
    ];

    protected $appends = ['game_data'];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function playerProductions(): HasMany
    {
        return $this->hasMany(PlayerProduction::class);
    }
    
    public function playerActions(): HasMany
    {
        return $this->hasMany(PlayerAction::class);
    }

    public function getGameDataAttribute(): ?object
    {
        $repo = app(CharacterRepository::class);
        return $repo->find($this->coid);
    }
}
