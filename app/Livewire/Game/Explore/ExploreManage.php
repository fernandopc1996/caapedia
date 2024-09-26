<?php

namespace App\Livewire\Game\Explore;

use Livewire\Attributes\Title;
use Livewire\Component;

class ExploreManage extends Component{

    #[Title('Exploração')] 

    public $name;

    public function save(){
        sleep(3);
        $this->name = "aaaa";
    }

    public function render()
    {
        return view('livewire.game.explore.explore-manage');
    }
}
