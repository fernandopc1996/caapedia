<?php

namespace App\Livewire\Game\People;

use Livewire\Attributes\Title;
use Livewire\Component;
use App\Repositories\CharacterRepository;

use App\Traits\LoadsPlayerFromSession;
use Session;

class PeopleManage extends Component
{
    use LoadsPlayerFromSession;

    #[Title('Pessoas')] 
    public $characters;

    public function mount() {
        $player =  $this->getPlayerFromSession();
        $this->characters = $player->playerCharacters()
        ->with(['playerProductions', 'playerActions'])
        ->get();
        $this->dispatch('playerUpdated');
        //dd($this->characters);
    }

    public function render(){
        return view('livewire.game.people.people-manage');
    }
}
