<?php

namespace App\Livewire\Game\Finance;

use App\Models\Game\Player;
use App\Services\Game\Finance\FinancialStatementService;
use App\Traits\LoadsPlayerFromSession;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;

class FinanceManage extends Component
{
    use LoadsPlayerFromSession;

    #[Title('Finanças')] 
    public ?Player $player = null;
    public $statements = [];
    public $year;

    public function mount(FinancialStatementService $service)
    {
        $this->player = $this->getPlayerFromSession();
        $this->year = $this->resolveYearFromPlayer();

        $this->loadStatement($service);

        $this->dispatch('playerUpdated');
    }

    public function previousYear(FinancialStatementService $service)
    {
        $this->year--;
        $this->loadStatement($service);
    }

    public function nextYear(FinancialStatementService $service)
    {
        $this->year++;
        $this->loadStatement($service);
    }

    public function canGoToPreviousYear(): bool
    {
        return $this->year > 1995;
    }

    public function canGoToNextYear(): bool
    {
        return $this->player && $this->year < Carbon::parse($this->player->last_datetime)->year;
    }

    protected function loadStatement(FinancialStatementService $service)
    {
        if ($this->player) {
            $this->statements = $service->generateMonthlyStatement($this->player->id, $this->year);
        }
    }

    protected function resolveYearFromPlayer(): int
    {
        return $this->player && $this->player->last_datetime
            ? Carbon::parse($this->player->last_datetime)->year
            : now()->year;
    }

    public function render()
    {
        return view('livewire.game.finance.finance-manage');
    }
}