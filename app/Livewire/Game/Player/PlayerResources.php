<?php

namespace App\Livewire\Game\Player;

use Livewire\Component;
use App\Traits\LoadsPlayerFromSession;
use App\Models\Game\Player;

class PlayerResources extends Component{
    use LoadsPlayerFromSession;

    public Player $player;

    protected $listeners = ['playerUpdated' => 'reloadPlayer'];

    public function mount()
    {
        $this->player = $this->getPlayerFromSession()
            ?? abort(403, 'Jogador não encontrado.');
    }

    public function reloadPlayer()
    {
        $this->player = $this->getPlayerFromSession();
    }

    public function render()
    {
        return view('livewire.game.player.player-resources');
    }
}