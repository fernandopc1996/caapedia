<?php

namespace App\Livewire\Game\Explore;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Services\Game\Exploration\ExplorationService;
use App\Models\Game\{Player};
use App\Repositories\ExplorationRepository;
use Mary\Traits\Toast;

class ExploreAction extends Component
{
    use Toast;

    public ?Player $player = null;
    public $explorations = [];
    public $selectedExplore = null;

    public $selectedCharacter = null;
    public $availableCharacters = [];
    protected ExplorationRepository $explorationRepository;

    public function boot(ExplorationRepository $explorationRepository)
    {
        $this->explorationRepository = $explorationRepository;
    }

    public function characterSeletorAction($params = [])
    {
        $this->selectedExplore = $params['selectedExplore'] ?? null;
        $service = app(ExplorationService::class);
        $result = $service->initExplorationAction(
            $this->selectedExplore,
            $this->selectedCharacter,
        );

        if ($result !== true) {
            $this->loadAvailableCharacters();
            $this->dispatch('playerUpdated');
            $this->error($result);
            return;
        }
        $this->success(
            'Exploração iniciada com sucesso',
            redirectTo: route('explore.manage')
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

    public function mount()
    {
        $this->explorations = $this->explorationRepository->all();
        $this->loadAvailableCharacters();
    }

    public function render()
    {
        $selectedExploreData = $this->selectedExplore ? $this->explorationRepository->find($this->selectedExplore) : null;
        return view('livewire.game.explore.explore-action', [
            'selectedExploreData' => $selectedExploreData
        ]);
    }
}
