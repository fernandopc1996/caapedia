<?php

namespace App\Livewire\Game\Production;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Services\Game\Production\ProductionService;
use App\Models\Game\{Player, PlayerProduction};
use App\Repositories\CropRepository;
use App\Enums\TypeAreaProduction;

use App\Traits\LoadsPlayerFromSession;
use Mary\Traits\Toast;

class ProductionCrop extends Component
{
    use Toast, LoadsPlayerFromSession;
    public ?PlayerProduction $production = null;
    public ?Player $player = null;
    public $crops = [];
    public $selectedCrop = null;
    public $optionalSelected = [];
    public int $cycle = 1;

    public $selectedCharacter = null;
    public $availableCharacters = [];
    protected CropRepository $cropRepository;

    public function boot(CropRepository $cropRepository)
    {
        $this->cropRepository = $cropRepository;
    }

    public function characterSeletorAction(){
        $service = app(ProductionService::class);
        $result = $service->createProductionActionAreaCrop($this->production, 
        $this->selectedCharacter, $this->selectedCrop, $this->optionalSelected, $this->cycle);
        if ($result !== true) {
            $this->loadAvailableCharacters();
            $this->dispatch('playerUpdated');
            $this->error($result);
            return;
        }
        $this->success(
            'Cultivo iniciado com sucesso',
            redirectTo: route('production.manage')
        );
    }

    public function updatedSelectedCrop($value)
    {
        $this->optionalSelected = [];
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

    public function mount(PlayerProduction $production)
    {
        $this->production = $production;

        if (isset($this->production) && $this->production->type_area != TypeAreaProduction::Cultivation) {
            $this->error(
                'Essa não é uma área de ' . TypeAreaProduction::Cultivation->label(),
                redirectTo: route('production.manage')
            );
        }
        $this->selectedCrop = $production->crop_coid;
        if($production){
            $lastAction = $this->production->playerActions()
                        ->where('coid', $production->crop_coid)
                        ->orderByDesc('cycles')
                        ->first();
            $this->cycle = $lastAction?->cycles + 1;
        }
        $this->crops = $this->cropRepository->all();
        $this->loadAvailableCharacters();
    }

    public function render()
    {
        $selectedCropData = $this->selectedCrop ? $this->cropRepository->find($this->selectedCrop) : null;

        return view('livewire.game.production.production-crop', [
            'selectedCropData' => $selectedCropData
        ]);
    }
}