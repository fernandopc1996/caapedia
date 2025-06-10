<?php

namespace Tests\Feature\Livewire\Game\Production;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Game\Player;
use App\Models\User;

class ProductionAreaTest extends TestCase
{
    use RefreshDatabase;

    public function test_production_area_screen_can_be_rendered(): void
    {
        $player = Player::factory()->create();
        $user = User::find($player->user_id);

        $response = $this->actingAs($user)
            ->withSession(['player_id' => $player->id])
            ->get(route('production.area', ['production' => null]));

        $response->assertOk();
    }
}