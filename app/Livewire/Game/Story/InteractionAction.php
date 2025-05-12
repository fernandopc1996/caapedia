<?php

namespace App\Livewire\Game\Story;

use Livewire\Component;
use App\Repositories\StoryRepository;
use App\Models\Game\Player;
use App\Services\Game\Story\StoryActionExecutor;
use App\Services\Game\Player\PlayerTimerService;
use App\Services\Game\Production\ProductionUpdateService;
use App\Traits\LoadsPlayerFromSession;

class InteractionAction extends Component
{
    use LoadsPlayerFromSession;

    public ?Player $player = null;
    public $activeStory = null;

    protected StoryRepository $storyRepository;
    protected StoryActionExecutor $executor;

    public function boot(StoryRepository $storyRepository)
    {
        $this->storyRepository = $storyRepository;
    }

    public function mount()
    {
        $this->player = $this->getPlayerFromSession();
        
        if ($this->player && $this->player->current_story) {
            $this->executor = new StoryActionExecutor($this->player);
            $this->activeStory = $this->storyRepository->find($this->player->current_story);
        }
    }

    public function action(string $choiceText, PlayerTimerService $playerTimerService, ProductionUpdateService $productionUpdateService)
    {
        if (!$this->player || !$this->player->current_story) return;

        $this->activeStory = $this->storyRepository->find($this->player->current_story);

        $choice = collect($this->activeStory->choices)
            ->firstWhere('text', $choiceText);
        if ($choice && isset($choice->actions) && is_array($choice->actions)) {
            $this->player = $playerTimerService
                ->setNow(now())
                ->setPlayer($this->player)
                ->updatePlayerTime();

            $executor = new StoryActionExecutor($this->player);
            $this->player = $executor->execute($this->activeStory, $choice->actions, $choiceText);
            $this->dispatch('playerUpdated');
            $this->dispatch('storyUpdated');
            $this->updatePlayerInSession($this->player);
            if($this->player->finished) return $this->redirectRoute('player.finished');
        }


        $this->activeStory = $this->player->current_story ? $this->storyRepository->find($this->player->current_story) : null;
    }

    public function render()
    {
        $parsedText = null;

        if ($this->player && $this->activeStory) {
            $executor = new StoryActionExecutor($this->player);
            $parsedText = $executor->parseText($this->activeStory->text);
        }

        return view('livewire.game.story.interaction-action', [
            'parsedText' => $parsedText,
        ]);
    }
}