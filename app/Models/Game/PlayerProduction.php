<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Repositories\{ProductionRepository, NativeCleaningRepository, CropRepository};
use Illuminate\Support\Str;
use App\Services\Game\Finance\FinancialStatementService;
use Carbon\Carbon;

use App\Enums\TypeAreaProduction;

class PlayerProduction extends Model
{

    protected $fillable = [
        'player_id',
        'type_area',
        'status_area',
        'native_cleaning_coid',
        'crop_coid',
        'sequence',
        'name',
        'coid',
        'start_build',
        'end_build',
        'player_character_id',
        'completed',
        'area',
        'degration',
        'water',
        'amount',
    ];

    protected $appends = ['game_data', 'native_cleaning_data', 'crop_data'];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();

            $lastSequence = self::where('player_id', $model->player_id)
            ->where('type_area', $model->type_area)
            ->max('sequence');

            $model->sequence = ($lastSequence ?? 0) + 1;

            $model->name = $model->type_area->label() . ' ' . $model->sequence;
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
        $date = $this->end_build ?? $this->start_build ?? now();
        $year = Carbon::parse($date)->year;
        app(FinancialStatementService::class)->clearCache($this->player_id, $year);
    }

    protected function casts(): array
    {
        return [
            'type_area' => TypeAreaProduction::class,
        ];
    }

    /**
     * Get the player that owns the production.
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function playerCharacter(): BelongsTo
    {
        return $this->belongsTo(PlayerCharacter::class);
    }

    public function playerActions(): HasMany
    {
        return $this->hasMany(PlayerAction::class);
    }

    public function playerActionAreas(): HasMany
    {
        return $this->hasMany(playerActionArea::class);
    }

    public function playerProducts(): HasMany
    {
        return $this->hasMany(PlayerProduct::class);
    }

    public function getPendingActionAttribute()
    {
        return $this->playerActions->firstWhere('completed', false);
    }

    public function getGameDataAttribute(): ?object
    {
        if($this->coid == null) return collect([]);
        $repo = app(ProductionRepository::class);
        return $repo->find($this->coid);
    }

    public function getNativeCleaningDataAttribute(): ?object
    {
        if($this->native_cleaning_coid == null) return collect([]);
        $repo = app(NativeCleaningRepository::class);
        return $repo->find($this->native_cleaning_coid);
    }

    public function getCropDataAttribute(): ?object
    {
        if($this->crop_coid == null) return collect([]);
        $repo = app(CropRepository::class);
        return $repo->find($this->crop_coid);
    }
}
