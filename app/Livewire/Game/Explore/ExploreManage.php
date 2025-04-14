<?php

namespace App\Livewire\Game\Explore;

use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Game\Player;
use App\Services\Game\Player\PlayerTimerService;
use App\Services\Game\Exploration\ExplorationUpdateService;
use App\Repositories\{ExplorationRepository};
use App\Traits\LoadsPlayerFromSession;

class ExploreManage extends Component{

    use LoadsPlayerFromSession;
    use WithPagination;

    #[Title('Exploração')] 
    public $productions;
    public ?Player $player = null;

    protected $listeners = ['updatePlayerTimer' => 'updatePlayerTimer'];

    public function updatePlayerTimer(
        PlayerTimerService $playerTimerService,
        ExplorationUpdateService $explorationUpdateService
    ) {
        $this->player = $playerTimerService
            ->setNow(now())
            ->setPlayer($this->player)
            ->updatePlayerTime();

        $this->updatePlayerInSession($this->player);

        $wasUpdated = $explorationUpdateService->handle($this->player);

        if ($wasUpdated) {
            $this->player->refresh();
        }
    }

    #[Computed]
    public function explorationPending()
    {
        if (!$this->player) return collect();

        return $this->player->playerActions()
            ->where('completed', false)
            ->where('coid_type', ExplorationRepository::class)
            ->get();
    }


    #[Computed]
    public function explorationCompleted()
    {
        if (!$this->player) return collect();

        return $this->player
            ->playerActions()
            ->with('playerCharacter', 'playerProducts')
            ->where('completed', true)
            ->where('coid_type', ExplorationRepository::class)
            ->orderBy('end', 'desc')
            ->limit(5)->get();
    }

    public function mount() {
        $this->player = $this->getPlayerFromSession();
        //$wasUpdated = $productionUpdateService->handle($this->player);
    }

    public function render()
    {
        return view('livewire.game.explore.explore-manage',
        [
            "pending" => $this->explorationPending(),
            "completed" => $this->explorationCompleted(),
        ]);
    }
}
