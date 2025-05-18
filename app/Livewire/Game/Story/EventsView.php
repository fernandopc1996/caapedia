<?php

namespace App\Livewire\Game\Story;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Game\Player;
use App\Models\Game\PlayerStory;
use App\Traits\LoadsPlayerFromSession;
use App\Services\Game\Story\StoryActionExecutor;
use Livewire\Attributes\On;

class EventsView extends Component
{
    use LoadsPlayerFromSession;
    
    #[Title('História')] 
    public ?Player $player = null;

    public function mount(): void
    {
        $this->player = $this->getPlayerFromSession();
        $this->dispatch('playerUpdated');
    }

    #[On('storyUpdated')]
    public function render()
    {
        $stories = PlayerStory::with('playerCharacter')
            ->where('player_id', $this->player?->id)
            ->orderByDesc('created_at')
            ->take(100)
            ->get()
            ->reverse();

        $executor = new StoryActionExecutor($this->player);

        return view('livewire.game.story.events-view', [
            'stories' => $stories,
            'executor' => $executor,
        ]);
    }
}
