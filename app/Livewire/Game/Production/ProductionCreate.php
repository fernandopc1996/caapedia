<?php

namespace App\Livewire\Game\Production;

use Livewire\Attributes\Title;
use Livewire\Component;
use App\Repositories\ProductionRepository;
use App\Models\Game\PlayerProduction;

class ProductionCreate extends Component{
    #[Title('Construir')] 
    public $productions;
    public ?int $coid = null;

    public function selectProduction($coid){
        $this->coid = $coid;
    }

    public function prepareArea(){
        $this->redirectRoute('production.area');
    }

    public function mount(ProductionRepository $productionRepository) {
        $productionRepository->clearCache();
        $this->productions = $productionRepository->all();
        //dd($this->productions, $productionRepository->search(["name" => "Gali"]));
    }

    public function render(){
        return view('livewire.game.production.production-create');
    }
}
