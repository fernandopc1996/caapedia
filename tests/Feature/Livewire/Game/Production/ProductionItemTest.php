<?php

namespace Tests\Feature\Livewire\Game\Production;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Game\{Player, PlayerCharacter, PlayerProduction};
use App\Models\User;

use App\Enums\TypeAreaProduction;

class ProductionItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_production_item_screen_can_be_rendered(): void
    {
        $player = Player::factory()->create();
        $user = User::find($player->user_id);

        $character = PlayerCharacter::create([
            'player_id' => $player->id,
            'coid' => 1,
        ]);

        $production = PlayerProduction::create([
            'player_id' => $player->id,
            'player_character_id' => $character->id,
            'coid' => 1,
            'type_area' => TypeAreaProduction::Breeding,
            'start_build' => now(),
            'end_build' => now(),
            'completed' => false,
            'area' => 0,
            'degration' => 0,
            'water' => 0,
            'amount' => 0,
        ]);

        $response = $this->actingAs($user)
            ->withSession(['player_id' => $player->id])
            ->get(route('production.item', ['production' => $production->uuid]));

        $response->assertOk();
    }
}
