<?php

namespace App\Livewire\Game\Player;

use Livewire\Component;
use App\Models\Game\Player;
use App\Repositories\StoryRepository;

use App\Traits\LoadsPlayerFromSession;

class PlayerFinished extends Component
{
    use LoadsPlayerFromSession;
    
    public ?Player $player = null;
    public $story = null;
    public $choice = null;

    public function mount(StoryRepository $storyRepository)
    {
        $this->player = $this->getPlayerFromSession();
        if ($this->player && $this->player->finished_story){
            $this->story = $storyRepository->find($this->player->finished_story);
            $this->choice = collect($this->story->choices)
                                ->firstWhere('text', $this->player->finished_choice);
        }
    }
    
    public function render()
    {
        return view('livewire.game.player.player-finished');
    }
}
