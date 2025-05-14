<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use App\Services\Game\Finance\FinancialStatementService;
use Carbon\Carbon;
use App\Enums\TypeFinance;

class PlayerFinance extends Model
{
    protected $fillable = [
        'uuid',
        'player_id',
        'player_character_id',
        'player_finance_id',
        'type',
        'op',
        'coid_type',
        'coid',
        'date',
        'installment',
        'installments',
        'description',
        'completed',
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

    protected function casts(): array
    {
        return [
            'type' => TypeFinance::class,
        ];
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

    public function finance(): BelongsTo
    {
        return $this->belongsTo(PlayerFinance::class, 'player_finance_id');
    }

    public function finances(): HasMany
    {
        return $this->hasMany(PlayerFinance::class, 'player_finance_id');
    }

    public function getGameDataAttribute(): ?object
    {
        if($this->coid_type == null) return null;
        $repo = app($this->coid_type);
        return $repo->find($this->coid);
    }

    public function calculateInstallmentValue(bool $simple = false): ?float
    {
        if (!$this->coid_type || !$this->coid || !$this->installments || !$this->amount) {
            return null;
        }

        $repo = app($this->coid_type);
        $data = $repo->find($this->coid);

        if (!isset($data->loan['rates'][$this->installments])) {
            return null;
        }

        $rate = $data->loan['rates'][$this->installments];
        $P = $this->amount;
        $n = $this->installments;
        $i = $rate;

        if ($simple) { // Juros simples
            $total = $P * (1 + ($i * $n));
            $installment = $total / $n;
        } else { // Juros compostos: PMT = P * [ i(1 + i)^n ] / [ (1 + i)^n – 1 ]
            $pow = pow(1 + $i, $n);
            $installment = ($P * $i * $pow) / ($pow - 1);
        }

        return round($installment, 2);
    }

}
