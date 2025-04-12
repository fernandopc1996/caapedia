<?php

namespace App\Livewire\Game\Production;

use Livewire\Component;
use App\Models\Game\PlayerProduction;

class ProductionProduced extends Component
{
    public ?PlayerProduction $production = null;

    public $headers = [
        ['key' => 'end', 'label' => 'Data', 'format' => ['date', 'd/m/Y H:i']],
        ['key' => 'product', 'label' => 'Produto'],
        ['key' => 'amount', 'label' => 'Quantidade']
    ];

    public function mount(PlayerProduction $production = null)
    {
        $this->production = $production;
    }

    #[Computed]
    public function products()
    {
        if ($this->production) 
            return $this->production->playerProducts()->where('op', 'C')->orderBy('end', 'desc')->limit(5)->get();
        return [];
    }

    public function render()
    {
        return view('livewire.game.production.production-produced', [
            "products" => $this->products(),
        ]);
    }
}
