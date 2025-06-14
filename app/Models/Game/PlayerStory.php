<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Repositories\StoryRepository;
use App\Repositories\EventRepository;
use Illuminate\Support\Str;
use App\Services\Game\Finance\FinancialStatementService;
use Carbon\Carbon;

class PlayerStory extends Model
{
    protected $fillable = [
        'uuid',
        'player_id',
        'player_character_id',
        'coid_type',
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

    public function getGameDataAttribute(): ?object
    {
        if($this->coid_type == null) return null;
        $repo = app($this->coid_type);
        return $repo->find($this->coid);
    }
}
