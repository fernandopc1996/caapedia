<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Services\Game\Finance\FinancialStatementService;
use Carbon\Carbon;

class PlayerWater extends Model
{
    protected $fillable = [
        'uuid',
        'player_id',
        'player_character_id',
        'date',
        'degration',
        'water',
        'amount',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
        static::created(function ($model) {
            $model->clearStatementCache();
        });
    
        static::updated(function ($model) {
            $model->clearStatementCache();
        });

        static::deleted(function ($model) {
            $model->clearStatementCache();
        });
    }
    
    public function clearStatementCache(): void
    {
        $date = $this->date ?? now();
        $year = Carbon::parse($date)->year;
        app(FinancialStatementService::class)->clearCache($this->player_id, $year);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function playerCharacter(): BelongsTo
    {
        return $this->belongsTo(PlayerCharacter::class);
    }
}
