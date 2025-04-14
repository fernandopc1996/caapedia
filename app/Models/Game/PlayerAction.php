<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class PlayerAction extends Model
{
    protected $fillable = [
        'player_id',
        'player_production_id',
        'player_character_id',
        'cycles',
        'coid_type',
        'coid',
        'completed',
        'start',
        'end',
        'increase_production',
        'area',
        'degration',
        'water',
        'amount',
    ];

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
}
