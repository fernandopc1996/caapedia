<?php

namespace Tests\Feature\Livewire\General\Score;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Game\Player;
use App\Models\User;

class RankingViewTest extends TestCase
{
    public function test_ranking_view_screen_can_be_rendered(): void
    {
        $this->withoutExceptionHandling(); 
        
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('general.score.ranking'));

        $response->assertOk();
    }
}
