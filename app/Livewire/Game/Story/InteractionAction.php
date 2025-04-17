<?php

namespace App\Livewire\Game\Story;

use Livewire\Component;
use App\Repositories\{StoryRepository};
use App\Models\Game\{Player};

use App\Traits\LoadsPlayerFromSession;

class InteractionAction extends Component
{
    use LoadsPlayerFromSession;

    public ?Player $player = null;
    public $activeStory = null;

    public function mount(StoryRepository $storyRepository){
        $this->activeStory = $storyRepository->find(1);
        $this->player = $this->getPlayerFromSession();
        //dd($this->activeStory);
    }

    public function action() {
        $this->activeStory = null;
    }

    public function render()
    {
        return view('livewire.game.story.interaction-action');
    }
}
