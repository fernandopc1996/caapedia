<?php

namespace App\Services\Game\Mechanics;

use App\Models\Game\Player;

class PlayerRateAdjustmentService
{

    public function applyYearlyAdjustment(Player $player): void
    {
        $rateSellIncrease = mt_rand(5, 50) / 100;
        $rateBuyIncrease = mt_rand(30, 50) / 100; 

        $player->rate_sell += $rateSellIncrease;
        $player->rate_buy += $rateBuyIncrease;
        $player->save();
    }
}
