<?php

namespace App\Livewire\Game\Production;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Session;
use App\Models\Game\Player;
use App\Models\Game\PlayerProduct;
use App\Models\Game\PlayerProduction;
use App\Repositories\ProductionRepository;
use App\Services\Game\Production\ProductionService;
use App\Traits\LoadsPlayerFromSession;
use Mary\Traits\Toast;

class ProductionItem extends Component
{
    use Toast, LoadsPlayerFromSession;

    public $productionSetting;
    public ?PlayerProduction $production = null;
    public $coid = null;
    public $selectedCharacter = null;
    public int $multiplier_quantity = 1;

    public $availableCharacters = [];
    public array $inputStock = [];

    public function mount(ProductionRepository $productionRepository, PlayerProduction $production = null, $coid = null)
    {
        $productionRepository->clearCache();
        $this->coid = $coid ?? $production?->coid;
        $this->productionSetting = $productionRepository->find($this->coid);

        $this->loadAvailableCharacters();
        $this->loadInputStock();
    }

    public function updatedMultiplierQuantity()
    {
        $this->loadInputStock();
    }

    protected function loadAvailableCharacters()
    {
        $player = $this->getPlayerFromSession();

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

    protected function loadInputStock()
    {
        $player = $this->getPlayerFromSession();
        $this->inputStock = [];

        if (!$player) return;
        //dd($this->productionSetting->production['inputs']);
        foreach ($this->productionSetting->production['inputs'] ?? [] as $input) {
            $balance = PlayerProduct::where('player_id', $player->id)
                ->where('coid', $input->id)
                ->selectRaw("SUM(CASE WHEN op = 'C' THEN amount ELSE -amount END) as balance")
                ->value('balance') ?? 0;

            $required = $input->qnt * $this->multiplier_quantity;

            $this->inputStock[$input->id] = [
                'required' => $required,
                'available' => $balance,
                'sufficient' => $balance >= $required,
            ];
        }
    }

    #[Computed]
    public function canProduce(): bool
    {
        if ($this->production == null) return true;
        foreach ($this->inputStock as $stock) {
            if (!$stock['sufficient']) {
                return false;
            }
        }
        return true;
    }

    public function characterSeletorAction()
    {
        if (!$this->canProduce()) {
            $this->error('Você não possui materiais suficientes para produzir.');
            return;
        }

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
                $this->coid,
                $this->multiplier_quantity
            );
        }

        if ($result !== true) {
            $this->loadAvailableCharacters();
            $this->loadInputStock();
            $this->dispatch('playerUpdated');
            $this->error($result);
        } else {
            $this->success(
                $this->production == null ? 'Produção criada com sucesso' : 'Ação criada com sucesso',
                redirectTo: route('production.manage')
            );
        }
    }

    public function render()
    {
        return view('livewire.game.production.production-item')
            ->title($this->productionSetting->name ?? 'Construir');
    }
}