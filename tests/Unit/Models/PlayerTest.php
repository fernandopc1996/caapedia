<?php

namespace Tests\Unit\Models;

use PHPUnit\Framework\TestCase;
use App\Models\Game\Player;

class PlayerTest extends TestCase
{
    public function test_get_inflation_value_for_sell_operation(): void
    {
        $player = new Player([
            'rate_sell' => 1.2,
            'rate_buy' => 0.8,
            'degration' => 0.1,
        ]);

        $this->assertEqualsWithDelta(13.0, $player->getInflationValue(10, 'D'), 1e-6);
    }

    public function test_get_inflation_value_for_buy_operation(): void
    {
        $player = new Player([
            'rate_sell' => 1.2,
            'rate_buy' => 0.8,
            'degration' => 0.1,
        ]);

        $this->assertEqualsWithDelta(7.0, $player->getInflationValue(10, 'C'), 1e-6);
    }
}
