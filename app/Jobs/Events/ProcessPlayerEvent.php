<?php

namespace App\Jobs\Events;

use App\Models\Game\Player;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;

use App\Services\Game\Finance\LoanInstallmentService;
use App\Services\Game\Finance\FamilyCostService;
use App\Services\Game\Mechanics\PlayerRateAdjustmentService;
use App\Services\Game\Events\FixedEventService;

class ProcessPlayerEvent implements ShouldQueue
{
    use Queueable;

    protected int $playerId;
    protected Carbon $simulatedDate;

    public $uniqueFor = 3600;

    protected ?Carbon $previousDate = null;

    public function __construct(int $playerId, string $simulatedDate, ?string $previousDate = null)
    {
        $this->playerId = $playerId;
        $this->simulatedDate = Carbon::parse($simulatedDate)->startOfDay();
        $this->previousDate = $previousDate ? Carbon::parse($previousDate)->startOfDay() : null;
    }

    public function uniqueId(): string
    {
        return "player_event_{$this->playerId}_{$this->simulatedDate->format('Ymd')}";
    }

    public function middleware(): array
    {
        return [
            (new WithoutOverlapping($this->uniqueId()))->dontRelease(),
        ];
    }

    public function handle(): void
    {
        $player = Player::find($this->playerId);
        if (!$player) return;

        app(FixedEventService::class, ['player' => $player])->process();

        $before = $this->previousDate ?? Carbon::parse($player->last_execution ?? $player->updated_at);
        $after = $this->simulatedDate;

        if ($before->month !== $after->month || $before->year !== $after->year) {
            $this->handleMonthly($player);
        }

        if ($before->year !== $after->year) {
            $this->handleYearly($player);
        }

        if (random_int(1, 100) === 1) {
            $this->handleRandom($player);
        }
    }

    protected function handleMonthly(Player $player): void
    {
        app(LoanInstallmentService::class)->processPendingInstallments($player, $this->simulatedDate);
        app(FamilyCostService::class)->processMonthlyCost($player, $this->simulatedDate);
    }

    protected function handleYearly(Player $player): void
    {
        app(PlayerRateAdjustmentService::class)->applyYearlyAdjustment($player);
    }

    protected function handleRandom(Player $player): void
    {
        // lógica futura para evento aleatório
    }
}
