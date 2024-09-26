<?php

namespace App\Livewire\Game\Finance;

use Livewire\Attributes\Title;
use Livewire\Component;

class FinanceManage extends Component
{
    #[Title('Finanças')] 

    public function render()
    {
        return view('livewire.game.finance.finance-manage');
    }
}
