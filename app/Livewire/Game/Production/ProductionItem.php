<?php

namespace App\Livewire\Game\Production;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Game\Player;
use App\Repositories\{ProductionRepository, ProductRepository};

class ProductionItem extends Component
{
    public $productionSetting;
    public $id = null;
    public $coid = null;
    public $selectedCharacter = null;

    public $availableCharacters = [];

    public function mount(ProductionRepository $productionRepository, $id = null, $coid = null)
    {
        $productionRepository->clearCache();

        $this->productionSetting = $productionRepository->find($coid);
        $this->id = $id;
        $this->coid = $coid;

        $this->loadAvailableCharacters();
    }

    public function characterSeletorAction()
    {
        sleep(2);
        //dd($this->selectedCharacter);
    }

    protected function loadAvailableCharacters()
    {
        $player = Session::get('player');

        if (!$player) {
            $this->availableCharacters = [];
            return;
        }

        $this->availableCharacters = $player->playerCharacters
        ->filter(fn($pc) => $pc->working < 3) 
        ->map(fn($pc) => [
            'id' => $pc->id,
            'name' => $pc->game_data->name ?? 'Sem nome', 
            'front_square' => $pc->game_data->front_square ?? null, 
        ])
        ->values()
        ->toArray();
    }

    public function render()
    {
        return view('livewire.game.production.production-item')
            ->title($this->productionSetting->name ?? 'Construir');
    }
}
