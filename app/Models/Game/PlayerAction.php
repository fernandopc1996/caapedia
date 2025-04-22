<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use App\Services\Game\Finance\FinancialStatementService;
use Carbon\Carbon;

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

    protected $appends = ['game_data'];

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
        $date = $this->end ?? $this->start ?? now();
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

    public function playerProduction(): BelongsTo
    {
        return $this->belongsTo(PlayerProduction::class);
    }

    public function playerProducts()
    {
        return $this->hasMany(PlayerProduct::class);
    }

    public function getGameDataAttribute(): ?object
    {
        if($this->coid_type == null) return null;
        $repo = app($this->coid_type);
        return $repo->find($this->coid);
    }
}
