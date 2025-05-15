<?php

namespace App\Livewire\Game\Production;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Game\Player;
use App\Repositories\{ProductionRepository, ProductRepository};
use App\Services\Game\Production\ProductionService;
use App\Models\Game\PlayerProduction;

use App\Traits\LoadsPlayerFromSession;
use Mary\Traits\Toast;

//TypeAreaProduction::Breeding or TypeAreaProduction::Manufacturing
class ProductionItem extends Component
{
    use Toast, LoadsPlayerFromSession;

    public $productionSetting;
    public ?PlayerProduction $production = null;
    public $coid = null;
    public $selectedCharacter = null;

    public $availableCharacters = [];

    public function mount(ProductionRepository $productionRepository, PlayerProduction $production = null, $coid = null)
    {
        $productionRepository->clearCache();
        $this->coid = $coid ?? $production?->coid;
        $this->productionSetting = $productionRepository->find($this->coid);
        

        $this->loadAvailableCharacters();
    }

    public function characterSeletorAction()
    {
        $service = app(ProductionService::class);

        if ($this->production == null) {
            $result = $service->createProduction(
                $this->productionSetting,
                $this->selectedCharacter,
                $this->coid
            );
        } else {
            $result = $service->createProductionAction(
                $this->production,
                $this->selectedCharacter,
                $this->coid
            );
        }

        if ($result !== true) {
            $this->loadAvailableCharacters();
            $this->dispatch('playerUpdated');
            $this->error($result);
        } else {
            if ($this->production == null) {
                $this->success(
                    'Produção criada com sucesso',
                    redirectTo: route('production.manage')
                );
            } else {
                $this->success(
                    'Ação criada com sucesso',
                    redirectTo: route('production.manage')
                );
            }
        }
    }


    protected function loadAvailableCharacters()
    {
        $player = $this->getPlayerFromSession();;

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
