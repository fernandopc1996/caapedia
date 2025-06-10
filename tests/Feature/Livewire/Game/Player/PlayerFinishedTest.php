<?php

namespace Tests\Feature\Livewire\Game\Player;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Game\Player;
use App\Models\User;

class PlayerFinishedTest extends TestCase
{
    use RefreshDatabase;

    public function test_player_finished_screen_can_be_rendered(): void
    {
        $player = Player::factory()->create(['finished' => 1]);
        $user = User::find($player->user_id);

        $response = $this->actingAs($user)
            ->withSession(['player_id' => $player->id])
            ->get(route('player.finished'));

        $response->assertOk();
    }
}
