<?php

namespace App\Livewire\Game\People;

use Livewire\Attributes\Title;
use Livewire\Component;
use App\Repositories\CharacterRepository;

class PeopleManage extends Component
{
    #[Title('Pessoas')] 
    public $characters;

    public function mount(CharacterRepository $characterRepository) {
        $characterRepository->clearCache();
        $this->characters = $characterRepository->all();
        //dd($this->characters);
    }

    public function render(){
        return view('livewire.game.people.people-manage');
    }
}
