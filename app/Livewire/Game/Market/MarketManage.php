<?php

namespace App\Livewire\Game\Market;

use Livewire\Attributes\Title;
use Livewire\Component;

class MarketManage extends Component
{
    #[Title('Mercado')] 

    public function render()
    {
        return view('livewire.game.market.market-manage');
    }
}
