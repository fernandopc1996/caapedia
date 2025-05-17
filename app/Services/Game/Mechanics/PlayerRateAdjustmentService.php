<?php

namespace App\Services\Game\Mechanics;

use App\Models\Game\Player;
use Illuminate\Support\Carbon;

class PlayerRateAdjustmentService
{
    protected int $startYear = 1995;
    protected int $limitYear = 2035;
    protected float $targetSell = 15.0;
    protected float $targetBuy = 20.0;

    public function applyYearlyAdjustment(Player $player): void
    {
        $currentYear = Carbon::parse($player->last_datetime)->year;

        $yearsRemaining = $this->limitYear - $currentYear;
        if ($yearsRemaining <= 0) {
            $yearsRemaining = 1; 
        }

        $currentSell = $player->rate_sell;
        $currentBuy  = $player->rate_buy;

        $randomSellIncrease = mt_rand(5, 50) / 100;  
        $randomBuyIncrease  = mt_rand(30, 50) / 100; 

        $projectedSell = $currentSell + ($randomSellIncrease * $yearsRemaining);
        $projectedBuy  = $currentBuy  + ($randomBuyIncrease  * $yearsRemaining);

        $finalSellIncrease = $randomSellIncrease;
        $finalBuyIncrease  = $randomBuyIncrease;

        if ($projectedSell < $this->targetSell) {
            $finalSellIncrease = max($randomSellIncrease, ($this->targetSell - $currentSell) / $yearsRemaining);
        }

        if ($projectedBuy < $this->targetBuy) {
            $finalBuyIncrease = max($randomBuyIncrease, ($this->targetBuy - $currentBuy) / $yearsRemaining);
        }

        $player->rate_sell = round($currentSell + $finalSellIncrease, 2);
        $player->rate_buy  = round($currentBuy + $finalBuyIncrease, 2);

        $player->save();
    }
}