<?php

namespace App\Livewire\Game\Production;

use Livewire\Attributes\Title;
use Livewire\Component;

class ProductionManage extends Component
{
    #[Title('Produção')] 
    public function render()
    {
        return view('livewire.game.production.production-manage');
    }
}
