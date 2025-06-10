<?php

namespace Tests\Feature\Livewire\Game\Finance;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Game\Player;
use App\Models\User;

class FinanceManageTest extends TestCase
{
    use RefreshDatabase;

    public function test_finance_manage_screen_can_be_rendered(): void
    {
        $player = Player::factory()->create();
        $user = User::find($player->user_id);

        $response = $this->actingAs($user)
            ->withSession(['player_id' => $player->id])
            ->get(route('finance.manage'));

        $response->assertOk();
    }
}
