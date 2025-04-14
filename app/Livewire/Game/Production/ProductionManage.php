<?php

namespace App\Livewire\Game\Production;

use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Livewire\Component;
use App\Repositories\ProductionRepository;
use App\Services\Game\Player\PlayerTimerService;
use App\Services\Game\Production\ProductionUpdateService;
use App\Models\Game\Player;



use App\Traits\LoadsPlayerFromSession;

class ProductionManage extends Component
{
    use LoadsPlayerFromSession;
    use WithPagination;

    #[Title('Produção')] 
    public $productions;
    public ?Player $player = null;

    protected $listeners = ['updatePlayerTimer' => 'updatePlayerTimer'];

    public function updatePlayerTimer(
        PlayerTimerService $playerTimerService,
        ProductionUpdateService $productionUpdateService
    ) {
        $this->player = $playerTimerService
            ->setNow(now())
            ->setPlayer($this->player)
            ->updatePlayerTime();

        $this->updatePlayerInSession($this->player);

        $wasUpdated = $productionUpdateService->handle($this->player);

        if ($wasUpdated) {
            $this->player->refresh();
        }
        //$this->resetPage();
        //$this->js('window.location.reload()'); 
    }

    public function mount(
        ProductionRepository $productionRepository,
        ProductionUpdateService $productionUpdateService
    ) {
        $productionRepository->clearCache();
        $this->productions = $productionRepository->all();
        $this->player = $this->getPlayerFromSession();

        $wasUpdated = $productionUpdateService->handle($this->player);
    }

    #[Computed]
    public function productionsPending()
    {
        if (!$this->player) return collect();

        return $this->player->playerProductions()
            ->with([
                'playerCharacter',
                'playerActions' => function ($query) {
                    $query->select('id', 'player_production_id', 'start', 'end', 'completed');
                }
            ])
            ->where(function ($query) {
                $query->where('completed', false)
                    ->orWhereHas('playerActions', function ($q) {
                        $q->where('completed', false)->whereNotNull('player_production_id');
                    });
            })
            ->get();
    }


    #[Computed]
    public function productionsCompleted()
    {
        if (!$this->player) return collect();

        return $this->player
            ->playerProductions()
            ->with('playerCharacter')
            ->where('completed', true)
            ->whereDoesntHave('playerActions', function ($query) {
                $query->where('completed', false)->whereNotNull('player_production_id');
            })
            ->get();
    }

    public function render()
    {
        return view('livewire.game.production.production-manage',
        [
            "pending" => $this->productionsPending(),
            "completed" => $this->productionsCompleted(),
        ]
    );
    }
}
