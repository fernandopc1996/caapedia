<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Repositories\CropRepository;
use Illuminate\Support\Str;

class PlayerActionArea extends Model
{
    protected $fillable = [
        'player_id',
        'player_production_id',
        'player_character_id',
        'cycles',
        'coid',
        'completed',
        'start',
        'end',
        'increase_production',
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

    public function playerProduction(): BelongsTo
    {
        return $this->belongsTo(PlayerProduction::class);
    }

    public function getGameDataAttribute(): ?object
    {
        $repo = app(CropRepository::class);
        return $repo->find($this->coid);
    }
}
