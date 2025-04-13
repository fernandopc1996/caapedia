<?php

namespace App\Livewire\Game\Market;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;


use App\Repositories\ProductRepository;

use App\Models\Game\PlayerProduct;
use App\Models\Game\Player;

use App\Traits\LoadsPlayerFromSession;
use Mary\Traits\Toast;

class MarketManage extends Component
{
    use WithPagination, Toast, LoadsPlayerFromSession;
    #[Title('Mercado')] 

    public $headers = [
        ['key' => 'name', 'label' => 'Produto', 'sortable' => true],
        ['key' => 'unit', 'label' => 'Unidade', 'sortable' => false], 
        ['key' => 'unit_value', 'label' => 'Preço (R$)', 'class' => 'font-bold text-right', 'format' => ['currency', '2,.', '']],
        ['key' => 'buy', 'label' => 'Comprar', 'sortable' => false], 
    ];

    public ?string $search = null;

    public array $sortBy = ['column' => 'coid', 'direction' => 'asc'];

    public ?Player $player = null;

    public array $expanded = [];
    
    #[Computed]
    public function products() {
        $productRepository = app(ProductRepository::class);
        $search = $this->search ? ["name" => $this->search] : [];
        $products = $productRepository->paginateSearch($search, 5, $this->sortBy);
        //dd($products);
        return $products->through(function ($item) {
            $item->unit_value = $this->player->getInflationValue($item->unit_value, "C");
            return $item;
        });;
    }

    public function buy($id, $qnt){
        try {
            DB::transaction(function () use ($id, $qnt) {
                $productRepository = app(ProductRepository::class);
                $productData = $productRepository->find($id);
    
                if (!$productData) {
                    $this->error('Produto não encontrado.');
                    throw new \Exception('Produto não encontrado.');
                }
    
                $unitValue = $this->player->getInflationValue($productData->unit_value, 'C');
    
                $totalCost = $qnt * $unitValue;
    
                if ($this->player->amount < $totalCost) {
                    $this->error('Saldo insuficiente para a compra.');
                    throw new \Exception('Saldo insuficiente para a compra.');
                }
    
                $this->player->decrement('amount', $totalCost);
    
                PlayerProduct::create([
                    'player_id'  => $this->player->id,
                    'coid'       => $id,
                    'op'         => 'C', 
                    'amount'     => $qnt,
                    'unit_value' => $unitValue,
                    'start'      => $this->player->last_datetime,
                    'end'        => $this->player->last_datetime,
                ]);
    
                $this->updatePlayerInSession($this->player);
                $this->dispatch('playerUpdated');
            });
            $this->success('Produto comprado com sucesso.');
            $this->resetPage();
        } catch (\Exception $e) {
            dd($e);
        }
    }    

    public function mount(){
        $this->player = $this->getPlayerFromSession();
    }

    public function render(){
        $products = $this->products();
        return view('livewire.game.market.market-manage',
            ['products' => $products]
        );
    }
}
