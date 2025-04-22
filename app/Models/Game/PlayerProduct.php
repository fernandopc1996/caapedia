<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use App\Repositories\ProductRepository;
use App\Services\Game\Finance\FinancialStatementService;
use Carbon\Carbon;

class PlayerProduct extends Model
{
    protected $fillable = [
        'player_id',
        'coid',
        'player_action_id',
        'player_production_id',
        'op',
        'amount',
        'unit_value',
        'start',
        'end',
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

    /**
     * Get the player that owns the product.
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * Get the related action that generated the product.
     */
    public function playerAction(): BelongsTo
    {
        return $this->belongsTo(PlayerAction::class);
    }

    /**
     * Get the related production that generated the product.
     */
    public function playerProduction(): BelongsTo
    {
        return $this->belongsTo(PlayerProduction::class);
    }

    public function getGameDataAttribute(): ?object
    {
        $repo = app(ProductRepository::class);
        return $repo->find($this->coid);
    }
}
