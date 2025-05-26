<?php

namespace App\Livewire\Game\Player;

use Livewire\Component;
use App\Services\Game\Player\PlayerTimerService;
use App\Models\Game\Player;
use Carbon\Carbon;
use Session;

use App\Traits\LoadsPlayerFromSession;

class ControlTimer extends Component{

    use LoadsPlayerFromSession;

    public Player $player;      

    public function setTimerMode($mode){
        $now = Carbon::now(); 
        $playerTimerService = new PlayerTimerService();
        $this->player = $playerTimerService
                            ->setNow($now)
                            ->setPlayer($this->player)
                            ->updatePlayerTime();

        $this->player->mode_time = $mode;
        $this->player->save();
        $this->updatePlayerInSession($this->player);
        $this->dispatch('timer-mode-updated', startTime: $this->player->last_datetime, mode: $this->player->mode_time); 
        $this->dispatch('playerUpdated');
    }

    public function mount(){
        $this->player = $this->getPlayerFromSession();
    }

    public function render(){
        return view('livewire.game.player.control-timer');
    }
}
