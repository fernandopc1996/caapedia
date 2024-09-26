<?php

namespace App\Livewire\Game\Inventory;

use Livewire\Attributes\Title;
use Livewire\Component;

class InventoryManage extends Component
{
    #[Title('Estoque')] 

    public function render()
    {
        return view('livewire.game.inventory.inventory-manage');
    }
}
