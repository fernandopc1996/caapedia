<?php

namespace App\Jobs\Events;

use App\Models\Game\{Player};
use App\Enums\{TypeEvent};
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\Game\Finance\LoanInstallmentService;
use App\Services\Game\Finance\FamilyCostService;
use App\Services\Game\Mechanics\PlayerRateAdjustmentService;

class ProcessPlayerEvent implements ShouldQueue
{
    use Queueable;

    protected int $playerId;
    protected TypeEvent $eventType;
    protected Carbon $simulatedDate;

    /**
     * Create a new job instance.
     */
    public function __construct(int $playerId, TypeEvent $eventType, string $simulatedDate)
    {
        $this->playerId = $playerId;
        $this->eventType = $eventType;
        $this->simulatedDate = Carbon::parse($simulatedDate)->startOfDay();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $player = Player::find($this->playerId);

        if (!$player) return;

        match ($this->eventType) {
            TypeEvent::Monthly => $this->handleMonthly($player),
            TypeEvent::Yearly  => $this->handleYearly($player),
            TypeEvent::Random  => $this->handleRandom($player),
        };
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
        // lógica de evento aleatório será implementada futuramente
    }
}