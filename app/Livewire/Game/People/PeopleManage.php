<?php

namespace App\Livewire\Game\People;

use Livewire\Attributes\Title;
use Livewire\Component;

class PeopleManage extends Component
{
    #[Title('Pessoas')] 

    public function render()
    {
        return view('livewire.game.people.people-manage');
    }
}
