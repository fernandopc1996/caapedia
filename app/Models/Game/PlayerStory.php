<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Repositories\StoryRepository;
use Illuminate\Support\Str;

class PlayerStory extends Model
{
    protected $fillable = [
        'uuid',
        'player_id',
        'player_character_id',
        'coid',
        'date',
        'choice',
        'degration',
        'water',
        'amount',
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

    public function playerCharacter(): BelongsTo
    {
        return $this->belongsTo(PlayerCharacter::class);
    }

    public function getGameDataAttribute(): ?object
    {
        $repo = app(StoryRepository::class);
        return $repo->find($this->coid);
    }
}
