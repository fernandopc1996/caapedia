<?php

namespace App\Livewire\Game\Production;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Session;
use App\Models\Game\{Player, PlayerProduction, PlayerActionArea};
use App\Repositories\{NativeCleaningRepository};
use App\Services\Game\Production\ProductionService;

use App\Enums\TypeAreaProduction;

use Mary\Traits\Toast;

//TypeAreaProduction::Cultivation
class ProductionAreaCrop extends Component
{
    use Toast;

    #[Title('Preparar área')] 
    public $nativeCleaning;
    public ?PlayerProduction $production = null;
    public ?PlayerActionArea $actionArea = null;
    public ?Player $player = null;
    public ?int $native_cleaning_coid = null;

    public $selectedCharacter = null;

    public $availableCharacters = [];

    public function characterSeletorAction($params = [])
    {
        $cleaningId = $params['native_cleaning_coid'] ?? null;

        if (!$cleaningId) {
            $this->error('Técnica inválida.');
            return;
        }

        $nativeCleaningSelected = $this->nativeCleaning->firstWhere('id', $cleaningId);

        if (!$nativeCleaningSelected || !$nativeCleaningSelected->available) {
            $this->error('Essa técnica não está disponível.');
            return;
        }

        $service = app(ProductionService::class);
        $result = $service->createProductionAreaCrop(
            $nativeCleaningSelected,
            $this->selectedCharacter,
        );

        if ($result !== true) {
            $this->loadAvailableCharacters();
            $this->dispatch('playerUpdated');
            $this->error($result);
        }
        $this->success(
            'Preparação de área iniciada com sucesso',
            redirectTo: route('production.manage')
        );
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


    public function mount(NativeCleaningRepository $nativeCleaningRepository)
    {
        if(isset($this->production) && $this->production->type_area != TypeAreaProduction::Cultivation){
            $this->error(
                'Essa não é uma área de '.TypeAreaProduction::Cultivation->label(),
                redirectTo: route('production.manage')
            );
        }elseif(isset($this->production)){
            dd("inicializar");
        }else{
            $this->nativeCleaning = $nativeCleaningRepository->all();
            //dd($this->nativeCleaning);
        }

        $this->loadAvailableCharacters();
    }

    public function render()
    {
        return view('livewire.game.production.production-area-crop')
            ->title($this->production->name ?? 'Preparar área');
    }
}
