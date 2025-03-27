<?php

namespace App\Livewire\Game\Production;

use Livewire\Attributes\Title;
use Livewire\Component;
use App\Repositories\ProductionRepository;
use App\Services\Game\Player\PlayerTimerService;
use App\Models\Game\{Player, PlayerProductions};

use App\Traits\LoadsPlayerFromSession;

class ProductionManage extends Component
{
    use LoadsPlayerFromSession;

    #[Title('Produção')] 
    public $productions;
    public ?Player $player = null;
    public $playerProductions = [];

    protected $listeners = ['updatePlayerTimer' => 'updatePlayerTimer'];


    public function updatePlayerTimer(PlayerTimerService $playerTimerService){
        $this->player = $playerTimerService
                ->setNow(now())
                ->setPlayer($this->player)
                ->updatePlayerTime();
        $this->updatePlayerInSession($this->player);
    }

    public function mount(ProductionRepository $productionRepository) {
        $productionRepository->clearCache();
        $this->productions = $productionRepository->all();
        $this->player = $this->getPlayerFromSession();
        $this->playerProductions = $this->player->playerProductions;
        //dd($this->playerProductions[1], $this->playerProductions[1]->game_data, $this->playerProductions[1]->playerCharacter->game_data);
        //dd($this->productions, $productionRepository->search(["name" => "Gali"]));
        if($this->player->playerProductions()->where('end_build', '<=', $this->player->last_datetime)->count() > 0){
            dd($this->player->playerProductions()->where('end_build', '<=', $this->player->last_datetime)->get());
        }
    }

    public function render(){
        return view('livewire.game.production.production-manage');
    }
}
