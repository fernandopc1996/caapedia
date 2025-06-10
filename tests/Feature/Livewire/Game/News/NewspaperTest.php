<?php

namespace Tests\Feature\Livewire\Game\News;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Game\Player;
use App\Models\User;

class NewspaperTest extends TestCase
{
    use RefreshDatabase;

    public function test_newspaper_screen_can_be_rendered(): void
    {
        $player = Player::factory()->create();
        $user = User::find($player->user_id);

        $response = $this->actingAs($user)
            ->withSession(['player_id' => $player->id])
            ->get(route('news.newspaper'));

        $response->assertOk();
    }
}
