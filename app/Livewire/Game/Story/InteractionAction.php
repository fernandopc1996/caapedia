<?php

namespace App\Livewire\Game\Story;

use Livewire\Component;
use App\Repositories\{StoryRepository};
use App\Models\Game\{Player};
use App\Services\Game\Story\StoryActionExecutor;

use App\Traits\LoadsPlayerFromSession;

class InteractionAction extends Component
{
    use LoadsPlayerFromSession;

    public ?Player $player = null;
    public $activeStory = null;
    protected StoryRepository $cropRepository;
    public int $teste = 2;

    public function boot(StoryRepository $storyRepository)
    {
        $this->storyRepository = $storyRepository;
    }

    public function mount(){
        $this->activeStory = $this->storyRepository->find(1);
        $this->player = $this->getPlayerFromSession();
        //dd($this->activeStory);
    }

    public function action() {
        $this->activeStory = null;
        if($this->teste > 4) return;
        $this->activeStory = $this->storyRepository->find($this->teste);
        $this->teste++;
    }

    public function render()
    {
        $executor = new StoryActionExecutor($this->player);
        $parsedText = $this->activeStory ? $executor->parseText($this->activeStory->text) : null;

        return view('livewire.game.story.interaction-action', [
            'parsedText' => $parsedText,
        ]);
    }

}
