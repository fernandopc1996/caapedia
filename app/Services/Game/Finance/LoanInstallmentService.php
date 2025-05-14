<?php

namespace App\Services\Game\Finance;

use App\Models\Game\Player;
use App\Models\Game\PlayerFinance;
use App\Enums\TypeFinance;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LoanInstallmentService
{
    public function processPendingInstallments(Player $player, Carbon $date): void
    {
        $pendingLoans = PlayerFinance::where('player_id', $player->id)
            ->where('type', TypeFinance::LOAN)
            ->where('completed', false)
            ->get();

        foreach ($pendingLoans as $loan) {
            DB::transaction(function () use ($loan, $player, $date) {
                $repo = app($loan->coid_type);
                $loanData = $repo->find($loan->coid);

                if (!isset($loanData->loan['rates'][$loan->installments])) {
                    return;
                }

                $installmentValue = $loan->calculateInstallmentValue();
                $startDate = Carbon::parse($loan->date)->startOfMonth();
                $monthsPassed = $startDate->diffInMonths($date->startOfMonth());
                $monthsPaid = $loan->finances()->count();
                $remaining = $loan->installments - $monthsPaid;

                $toCreate = min($monthsPassed + 1 - $monthsPaid, $remaining);
                if ($toCreate <= 0) return;

                for ($i = 0; $i < $toCreate; $i++) {
                    $installmentNumber = $monthsPaid + $i + 1;
                    $installmentDate = $startDate->copy()->addMonths($monthsPaid + $i);

                    PlayerFinance::create([
                        'player_id' => $player->id,
                        'player_finance_id' => $loan->id,
                        'type' => TypeFinance::LOAN,
                        'op' => 'D',
                        'coid_type' => $loan->coid_type,
                        'coid' => $loan->coid,
                        'date' => $installmentDate,
                        'installment' => $installmentNumber,
                        'installments' => $loan->installments,
                        'amount' => $installmentValue,
                        'description' => "{$loan->description} ({$installmentNumber}/{$loan->installments})",
                        'completed' => true,
                    ]);

                    $player->decrement('amount', $installmentValue);
                }

                if ($loan->finances()->count() >= $loan->installments) {
                    $loan->update(['completed' => true]);
                }
            });
        }
    }
}