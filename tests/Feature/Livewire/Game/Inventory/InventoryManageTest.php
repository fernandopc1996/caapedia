<?php

namespace Tests\Feature\Livewire\Game\Inventory;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Game\Player;
use App\Models\User;

class InventoryManageTest extends TestCase
{
    use RefreshDatabase;

    public function test_inventory_manage_screen_can_be_rendered(): void
    {
        $player = Player::factory()->create();
        $user = User::find($player->user_id);

        $response = $this->actingAs($user)
            ->withSession(['player_id' => $player->id])
            ->get(route('inventory.manage'));

        $response->assertOk();
    }
}
