<?php

namespace Tests\Unit\Services\Game\Mechanics;

use PHPUnit\Framework\TestCase;

use App\Services\Game\Mechanics\WeightedRandomPicker;

class WeightedRandomPickerTest extends TestCase
{
    public function test_pick_returns_first_item_when_others_have_zero_weight(): void
    {
        $picker = new WeightedRandomPicker(['A' => 1, 'B' => 0]);
        $this->assertSame('A', $picker->pick());
    }

    public function test_pick_returns_last_item_when_first_has_zero_weight(): void
    {
        $picker = new WeightedRandomPicker(['A' => 0, 'B' => 1]);
        $this->assertSame('B', $picker->pick());
    }
}
