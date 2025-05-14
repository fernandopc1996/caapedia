<?php

namespace App\Services\Game\Finance;

use App\Models\Game\Player;
use App\Models\Game\PlayerFinance;
use App\Enums\TypeFinance;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FamilyCostService
{
    public function processMonthlyCost(Player $player, Carbon $date): void
    {
        DB::transaction(function () use ($player, $date) {
            $characters = $player->playerCharacters()->count();
            if ($characters === 0) return;

            $lastCost = PlayerFinance::where('player_id', $player->id)
                ->where('type', TypeFinance::COSTS)
                ->orderByDesc('date')
                ->first();

            $startDate = $lastCost ? Carbon::parse($lastCost->date)->startOfMonth()->addMonth() : Carbon::parse('1995-01-01');
            $endDate = $date->copy()->startOfMonth();

            while ($startDate->lessThanOrEqualTo($endDate)) {
                $amount = $characters * $player->getInflationValue(500, 'D');

                PlayerFinance::create([
                    'player_id' => $player->id,
                    'type' => TypeFinance::COSTS,
                    'op' => 'D',
                    'coid_type' => null,
                    'coid' => null,
                    'date' => $startDate->copy(),
                    'installment' => null,
                    'installments' => null,
                    'amount' => $amount,
                    'description' => "Custo familiar mensal",
                    'completed' => true,
                ]);

                $player->decrement('amount', $amount);
                $startDate->addMonth();
            }
        });
    }
}