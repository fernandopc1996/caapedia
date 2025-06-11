<?php

namespace App\Livewire\Game\Inventory;

use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Game\PlayerProduct;
use App\Models\Game\Player;
use Illuminate\Support\Facades\DB;
use App\Traits\LoadsPlayerFromSession;
use Mary\Traits\Toast;

class InventoryManage extends Component
{
    use WithPagination, Toast, LoadsPlayerFromSession;

    #[Title('Estoque')] 
    public $headers = [
        ['key' => 'product', 'label' => 'Produto', 'sortable' => false],
        ['key' => 'unit', 'label' => 'Unidade', 'sortable' => false], 
        ['key' => 'unit_value', 'label' => 'Preço (R$)', 'class' => 'font-bold text-right', 'format' => ['currency', '2,.', ''], 'sortable' => false],
        ['key' => 'balance', 'label' => 'Saldo', 'class' => 'font-bold text-right', 'format' => ['currency', '0,.', '']],
        ['key' => 'sell', 'label' => 'Vender', 'sortable' => false], 
    ];

    public array $expanded = [];

    public ?Player $player = null;

    public array $sortBy = ['column' => 'coid', 'direction' => 'asc'];

    public ?string $search = null;

    public array $searchCoid = [];

    public bool $showModal = false;
    public ?object $modalProduct = null;

    public function updated($property): void
    {
        if (! is_array($property) && $property != "") {
            $this->resetPage();
        }
    }

    public function openModal($coid)
    {
        $productRepository = app(\App\Repositories\ProductRepository::class);

        $balance = PlayerProduct::where('player_id', $this->player->id)
            ->where('coid', $coid)
            ->selectRaw("SUM(CASE WHEN op = 'C' THEN amount ELSE -amount END) as balance")
            ->value('balance');

        if (!$balance) {
            $this->error('Produto sem saldo em estoque.');
            return;
        }

        $gameData = $productRepository->find($coid);

        if (!$gameData) {
            $this->error('Produto não encontrado.');
            return;
        }

        $modalProduct = new \stdClass();
        $modalProduct->coid = $coid;
        $modalProduct->balance = $balance;
        $modalProduct->game_data = $gameData;
        $modalProduct->unit_value = $this->player->getInflationValue($gameData->unit_value, "D");
        $modalProduct->unit = $gameData->unit;

        $this->modalProduct = $modalProduct;
        $this->showModal = true;
    }


    public function sell($coid, $qnt){
        try {
            DB::transaction(function () use ($coid, $qnt) {
                $productRepository = app(\App\Repositories\ProductRepository::class);
                $productData = $productRepository->find($coid);

                if (!$productData) {
                    $this->error('Produto não encontrado.');
                    throw new \Exception('Produto não encontrado.');
                }

                $this->showModal = false;

                $unitValue = $this->player->getInflationValue($productData->unit_value, 'D');

                $currentBalance = PlayerProduct::where('player_id', $this->player->id)
                    ->where('coid', $coid)
                    ->selectRaw("SUM(CASE WHEN op = 'C' THEN amount ELSE -amount END) as balance")
                    ->value('balance');

                if ($currentBalance < $qnt) {
                    $this->error('Saldo insuficiente para a venda.');
                    throw new \Exception('Saldo insuficiente para a venda.');
                }

                PlayerProduct::create([
                    'player_id'  => $this->player->id,
                    'coid'       => $coid,
                    'op'         => 'D', 
                    'amount'     => $qnt,
                    'unit_value' => $unitValue,
                    'start' => $this->player->last_datetime,
                    'end' => $this->player->last_datetime,
                ]);

                $totalSaleValue = $qnt * $unitValue;
                $this->player->increment('amount', $totalSaleValue);
                $this->updatePlayerInSession($this->player);
                $this->dispatch('playerUpdated');
            });
            $this->success('Produto vendido com sucesso.');
            $this->resetPage();
        } catch (\Exception $e) {
            dd($e);
        }
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
                ->paginate(5)
                ->through(function ($item) use ($productRepository) {
                    $item->game_data = $productRepository->find($item->coid);
                    $item->unit_value = $this->player->getInflationValue($item->game_data->unit_value, "D");
                    $item->unit = $item->game_data->unit;
                    return $item;
                });
    }

    public function mount(){
        $this->player = $this->getPlayerFromSession();
        $this->dispatch('playerUpdated');
    }

    public function render()
    {
        //dd($this->products());
        return view('livewire.game.inventory.inventory-manage', [
            'products' => $this->products(),
        ]);
    }
}
