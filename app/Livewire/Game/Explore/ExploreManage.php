<?php

namespace App\Livewire\Game\Explore;

use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Game\Player;
use App\Services\Game\Player\PlayerTimerService;
use App\Services\Game\Production\ProductionUpdateService;
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
        ProductionUpdateService $productionUpdateService
    ) {

    }
    #[Computed]
    public function explorationPending()
    {
        if (!$this->player) return collect();

        return $this->player->playerActions()
            ->where('completed', false)
            ->where('coid_type', ExplorationRepository::class)
            ->first();
    }


    #[Computed]
    public function explorationCompleted()
    {
        if (!$this->player) return collect();

        return $this->player
            ->playerActions()
            ->with('playerCharacter')
            ->where('completed', true)
            ->where('coid_type', ExplorationRepository::class)
            ->get();
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
