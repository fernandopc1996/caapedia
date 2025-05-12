<?php

namespace App\Livewire\Game\Market;

use App\Models\Game\Player;
use App\Models\Game\PlayerWater;
use App\Services\Game\Finance\FinancialStatementService;
use App\Traits\LoadsPlayerFromSession;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Mary\Traits\Toast;

class WaterPurchase extends Component
{
    use Toast, LoadsPlayerFromSession;

    public ?Player $player = null;
    public float $unitPrice = 0; 
    public int $maxQuantity = 0;
    public int $quantity = 0;

    public function mount()
    {
        $this->player = $this->getPlayerFromSession();
        $this->unitPrice = $this->player->getInflationValue(0.75, 'C');
        $this->calculateMax();
    }

    public function updatedQuantity()
    {
        $this->quantity = max(0, min($this->quantity, $this->maxQuantity));
    }

    protected function calculateMax(): void
    {
        $this->maxQuantity = (int) floor($this->player->amount / $this->unitPrice);

    }

    public function buyWater(){
        try {
            DB::transaction(function () {
                $totalCost = $this->quantity * $this->unitPrice;

                if ($this->quantity <= 0 || $this->player->amount < $totalCost) {
                    $this->error('Compra inválida ou saldo insuficiente.');
                    throw new \Exception('Compra inválida ou saldo insuficiente.');
                }

                $this->player->decrement('amount', $totalCost);
                $this->player->increment('water', $this->quantity);

                PlayerWater::create([
                    'player_id' => $this->player->id,
                    'date' => $this->player->last_datetime,
                    'amount' => $totalCost,
                    'water' => $this->quantity,
                    'degration' => 0,
                ]);

                $this->updatePlayerInSession($this->player);
                $this->dispatch('playerUpdated');
            });

            $this->success("Você comprou {$this->quantity}m³ de água.");
            $this->reset('quantity');
            $this->calculateMax();
        } catch (\Exception $e) {
            report($e);
        }
    }

    public function render()
    {
        return view('livewire.game.market.water-purchase');
    }
}
