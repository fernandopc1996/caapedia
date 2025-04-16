<?php

namespace App\Livewire\Game\People;

use Livewire\Attributes\Title;
use Livewire\Component;
use App\Repositories\CharacterRepository;
use Session;

class PeopleManage extends Component
{
    #[Title('Pessoas')] 
    public $characters;

    public function mount() {
        $player = Session::get('player');
        $this->characters = $player->playerCharacters()
        ->with(['playerProductions', 'playerActions'])
        ->get();
        //dd($this->characters);
    }

    public function render(){
        return view('livewire.game.people.people-manage');
    }
}
