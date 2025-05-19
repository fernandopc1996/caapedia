<?php

namespace App\Services\Game\Events;

use App\Models\Game\Player;
use Illuminate\Support\Carbon;
use App\Services\Game\Finance\LoanInstallmentService;
use App\Services\Game\Finance\FamilyCostService;
use App\Services\Game\Mechanics\PlayerRateAdjustmentService;
use App\Services\Game\Events\FixedEventService;

class PlayerEventProcessorService
{
    public function process(Player $player, Carbon $simulatedDate, ?Carbon $previousDate = null): void
    {
        app(FixedEventService::class, ['player' => $player])->process();

        $before = $previousDate ?? Carbon::parse($player->last_execution ?? $player->updated_at);
        $after = $simulatedDate;

        if ($before->month !== $after->month || $before->year !== $after->year) {
            $this->handleMonthly($player, $simulatedDate);
        }

        if ($before->year !== $after->year) {
            $this->handleYearly($player);
        }

        if (random_int(1, 100) === 1) {
            $this->handleRandom($player);
        }
    }

    protected function handleMonthly(Player $player, Carbon $simulatedDate): void
    {
        app(LoanInstallmentService::class)->processPendingInstallments($player, $simulatedDate);
        app(FamilyCostService::class)->processMonthlyCost($player, $simulatedDate);
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