<?php

namespace Tests\Feature\Livewire\Game\Story;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Game\Player;
use App\Models\User;

class EventsViewTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_events_view_screen_can_be_rendered(): void
    {
        $player = Player::factory()->create();
        $user = User::find($player->user_id);

        $response = $this->actingAs($user)
            ->withSession(['player_id' => $player->id])
            ->get(route('story.events'));

        $response->assertOk();
    }
}
