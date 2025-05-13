<?php

namespace App\Livewire\Game\Finance;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Game\Player;
use App\Models\Game\PlayerFinance;
use App\Repositories\LoanRepository;
use App\Services\Game\Finance\LoanService;
use App\Traits\LoadsPlayerFromSession;

use App\Enums\TypeFinance;
use Mary\Traits\Toast;

class LoanManage extends Component
{
    use Toast, LoadsPlayerFromSession;

    public ?Player $player = null;
    public $loans = [];
    public array $installments = [];

    protected LoanRepository $loanRepository;

    public function boot(LoanRepository $loanRepository)
    {
        $this->loanRepository = $loanRepository;
    }

    public function mount()
    {
        $this->player = $this->getPlayerFromSession();
        $this->loans = $this->loanRepository->all();
    }

    public function loanSubmit($loanId)
    {
        $loan = $this->loanRepository->find($loanId);
        $installments = $this->installments[$loanId] ?? null;

        if (!$loan) {
            return $this->error('Dados inválidos para o empréstimo.');
        }

        if (!$installments) {
            return $this->error('Selecione a quantidade de parcelas.');
        }

        if (!in_array($installments, $loan->loan['installments'])) {
            return $this->error('Quantidade de parcelas inválida.');
        }

        $hasLoan = $this->player->playerFinances()
                        ->where('type', TypeFinance::LOAN)
                        ->where('op', 'C')
                        ->where('coid_type', LoanRepository::class)
                        ->where('coid', $loanId)
                        ->where('completed', false)
                        ->exists();

        if ($hasLoan) {
            return $this->error('Você já possui esse empréstimo ativo.');
        }

        if ($loan->loan['min_trust'] > $this->player->getInflationValue(1, 'C')) {
            return $this->error('Empréstimo indisponível para sua confiança atual.');
        }

        try {
            DB::transaction(function () use ($loan, $installments) {
                $rate = $loan->loan['rates'][$installments];
                $principal = $loan->loan['max_amount'] * $this->player->getInflationValue(1, 'C');

                $this->player->increment('amount', $principal);

                PlayerFinance::create([
                    'player_id' => $this->player->id,
                    'type' => TypeFinance::LOAN,
                    'op' => 'C',
                    'coid_type' => LoanRepository::class,
                    'coid' => $loan->id,
                    'date' => $this->player->last_datetime,
                    'installments' => $installments,
                    'description' => $loan->name,
                    'completed' => false,
                    'amount' => $principal,
                ]);

                $this->updatePlayerInSession($this->player);
                $this->dispatch('playerUpdated');
            });

            $this->success('Empréstimo contratado com sucesso.');
            unset($this->installments[$loanId]);
        } catch (\Exception $e) {
            report($e);
            $this->error('Erro ao contratar o empréstimo.');
        }
    }

    public function render()
    {
        return view('livewire.game.finance.loan-manage');
    }
}