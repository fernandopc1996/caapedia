<?php

namespace App\Livewire\Game\Inventory;

use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Game\PlayerProduct;
use App\Models\Game\Player;
use Illuminate\Support\Facades\DB;
use App\Traits\LoadsPlayerFromSession;

class InventoryManage extends Component
{
    use WithPagination, LoadsPlayerFromSession;

    #[Title('Estoque')] 
    public $headers = [
        ['key' => 'coid', 'label' => 'Produto'],
        ['key' => 'balance', 'label' => 'Saldo', 'class' => 'font-bold text-right', 'format' => ['currency', '0,.', '']],
        ['key' => 'sell', 'label' => 'Vender', 'sortable' => false], 
    ];

    public ?Player $player = null;

    public array $sortBy = ['column' => 'coid', 'direction' => 'asc'];

    public ?string $search = null;

    public array $searchCoid = [];

    public function updated($property): void
    {
        if (! is_array($property) && $property != "") {
            $this->resetPage();
        }
    }

    public function sell($coid, $qnt){
        //dd($coid, $qnt);
    }

    public function products()
    {
        $productRepository = app(\App\Repositories\ProductRepository::class);
        $query = $this->player->playerProducts();
        if ($this->search) {
            $matchingProducts = $productRepository->search(['name' => $this->search]);
            $coids = $matchingProducts->pluck('id')->toArray();
            if (!empty($coids)) $query->whereIn('coid', $coids);
        }

        $query->select('coid', \DB::raw("SUM(CASE WHEN op = 'C' THEN amount ELSE -amount END) as balance"))
                ->groupBy('coid')->having('balance', '!=', 0);
        return $query->orderBy(...array_values($this->sortBy))
                ->paginate(2)
                ->through(function ($item) use ($productRepository) {
                    $item->game_data = $productRepository->find($item->coid);
                    return $item;
                });
    }

    public function mount(){
        $this->player = $this->getPlayerFromSession();
    }

    public function render()
    {
        //dd($this->products());
        return view('livewire.game.inventory.inventory-manage', [
            'products' => $this->products(),
        ]);
    }
}
