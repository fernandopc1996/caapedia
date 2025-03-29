<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
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

    public function getGameDataAttribute(): ?object
    {
        $repo = app(CharacterRepository::class);
        return $repo->find($this->coid);
    }
}
