<?php

namespace App\Livewire\Game\Production;

use Livewire\Component;
use App\Models\Game\PlayerProduction;

class ProductionProduced extends Component
{
    public ?PlayerProduction $production = null;
    public bool $manejo = false;

    public $headers = [
        ['key' => 'end', 'label' => 'Data', 'format' => ['date', 'd/m/Y H:i']],
        ['key' => 'product', 'label' => 'Produto'],
        ['key' => 'amount', 'label' => 'Quantidade', 'class' => 'font-bold text-right', 'format' => ['currency', '0,.', '']]
    ];

    public function mount(PlayerProduction $production = null, bool $manejo = false)
    {
        $this->production = $production;
        $this->manejo = $manejo;
    }

    #[Computed]
    public function products()
    {
        if ($this->production){
            $products = $this->production->playerProducts()->where('op', 'C');
            if($this->manejo == true) $products->whereNull('player_action_id');
            if($this->manejo == false) $products->whereNotNull('player_action_id');
            return $products->orderBy('end', 'desc')->limit(5)->get();
        } 
            
        return [];
    }

    public function render()
    {
        return view('livewire.game.production.production-produced', [
            "products" => $this->products(),
        ]);
    }
}
