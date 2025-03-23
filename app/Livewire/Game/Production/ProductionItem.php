<?php

namespace App\Livewire\Game\Production;

use Livewire\Component;
use App\Repositories\{ProductionRepository, ProductRepository};

class ProductionItem extends Component{
    public $productionSetting;
    public $id = null;
    public $coid = null;
    public $selectedCharacter = null;

    public function mount(ProductionRepository $productionRepository, $id = null, $coid = null) {
        $productionRepository->clearCache();
       
        $this->productionSetting = $productionRepository->find($coid);
        
        $this->id = $id;
        $this->coid = $coid;
        //dd($this->productionSetting);
        // $this->productionSet->name;
    }

    public function render(){
        return view('livewire.game.production.production-item')->title($this->productionSetting->name ?? 'Construir');
    }
}
