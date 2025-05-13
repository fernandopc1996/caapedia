<?php

namespace App\Services\Game\Finance;

use App\Models\Game\{
    PlayerProduction, PlayerAction, PlayerActionArea,
    PlayerProduct, PlayerStory, PlayerWater, PlayerFinance, Player
};
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class FinancialStatementService
{
    public function generateMonthlyStatement(int $playerId, ?int $year = null): array
    {
        $year = $year ?? $this->resolveYearFromPlayer($playerId);

        return Cache::remember("player:{$playerId}:monthly_statement:{$year}", now()->addHours(1), function () use ($playerId, $year) {
            return $this->buildStatement($playerId, $year);
        });
    }

    public function clearCache(int $playerId, ?int $year = null): void
    {
        $year = $year ?? $this->resolveYearFromPlayer($playerId);
        Cache::forget("player:{$playerId}:monthly_statement:{$year}");
    }

    public function refreshStatement(int $playerId, ?int $year = null): array
    {
        $this->clearCache($playerId, $year);
        return $this->generateMonthlyStatement($playerId, $year);
    }

    protected function resolveYearFromPlayer(int $playerId): int
    {
        $player = Player::find($playerId);
        return optional($player)->last_datetime 
            ? Carbon::parse($player->last_datetime)->year 
            : now()->year;
    }

    protected function buildStatement(int $playerId, int $year): array
    {
        $entries = collect();
    
        PlayerProduct::where('player_id', $playerId)
            ->whereYear('end', $year)
            ->orWhere(function ($query) use ($playerId, $year) {
                $query->where('player_id', $playerId)
                      ->whereNull('end')
                      ->whereYear('start', $year);
            })
            ->get()
            ->each(function ($product) use ($entries) {
                if ($product->unit_value === null) return;
    
                $date = Carbon::parse($product->end ?? $product->start);
                $month = $date->startOfMonth()->format('Y-m');
                $total = $product->amount * $product->unit_value;
                $type = $product->op === 'C' ? 'débito' : 'crédito';
                $label = $product->op === 'C' ? 'Compra de produtos' : 'Venda de produtos';
    
                $entries->push([
                    'date'   => $month,
                    'label'  => $label,
                    'type'   => $type,
                    'amount' => $total,
                ]);
            });
    
        PlayerAction::where('player_id', $playerId)
            ->whereYear('end', $year)
            ->orWhere(function ($query) use ($playerId, $year) {
                $query->where('player_id', $playerId)
                      ->whereNull('end')
                      ->whereYear('start', $year);
            })
            ->get()
            ->each(function ($action) use ($entries) {
                if ($action->amount <= 0) return;
    
                $date = Carbon::parse($action->end ?? $action->start);
                $entries->push([
                    'date'   => $date->startOfMonth()->format('Y-m'),
                    'label'  => 'Produção',
                    'type'   => 'débito',
                    'amount' => $action->amount,
                ]);
            });
    
        PlayerActionArea::where('player_id', $playerId)
            ->whereYear('end', $year)
            ->orWhere(function ($query) use ($playerId, $year) {
                $query->where('player_id', $playerId)
                      ->whereNull('end')
                      ->whereYear('start', $year);
            })
            ->get()
            ->each(function ($action) use ($entries) {
                if ($action->amount <= 0) return;
    
                $date = Carbon::parse($action->end ?? $action->start);
                $entries->push([
                    'date'   => $date->startOfMonth()->format('Y-m'),
                    'label'  => 'Produção',
                    'type'   => 'débito',
                    'amount' => $action->amount,
                ]);
            });
    
        PlayerProduction::where('player_id', $playerId)
            ->whereYear('end_build', $year)
            ->orWhere(function ($query) use ($playerId, $year) {
                $query->where('player_id', $playerId)
                      ->whereNull('end_build')
                      ->whereYear('start_build', $year);
            })
            ->get()
            ->each(function ($prod) use ($entries) {
                if ($prod->amount <= 0) return;
    
                $date = Carbon::parse($prod->end_build ?? $prod->start_build);
                $entries->push([
                    'date'   => $date->startOfMonth()->format('Y-m'),
                    'label'  => 'Construção de área',
                    'type'   => 'débito',
                    'amount' => $prod->amount,
                ]);
            });
    
        PlayerStory::where('player_id', $playerId)
            ->whereYear('date', $year)
            ->get()
            ->each(function ($story) use ($entries) {
                if ($story->amount == 0) return;
                $date = Carbon::parse($story->date);
                $type = $story->amount < 0 ? 'débito' : 'crédito';
                $entries->push([
                    'date'   => $date->startOfMonth()->format('Y-m'),
                    'label'  => $story->game_data->event ?? 'Evento',
                    'type'   => $type,
                    'amount' => $story->amount,
                ]);
            });

        PlayerWater::where('player_id', $playerId)
            ->whereYear('date', $year)
            ->get()
            ->each(function ($water) use ($entries) {
                if ($water->amount === 0 || $water->water === 0) return;

                $date = Carbon::parse($water->date)->startOfMonth()->format('Y-m');
                $isPurchase = $water->water > 0;
                $type = $isPurchase ? 'débito' : 'crédito';
                $label = $isPurchase ? 'Compra de água' : 'Venda de água';
                $total = abs($water->amount); 

                $entries->push([
                    'date'   => $date,
                    'label'  => $label,
                    'type'   => $type,
                    'amount' => $total,
                ]);
            });

        PlayerFinance::where('player_id', $playerId)
            ->whereYear('date', $year)
            ->get()
            ->each(function ($finance) use ($entries) {
                if ($finance->amount == 0) return;

                $date = Carbon::parse($finance->date)->startOfMonth()->format('Y-m');
                $type = $finance->op === 'C' ? 'crédito' : 'débito';
                $label = $finance->description ?? 'Movimento financeiro';

                $entries->push([
                    'date'   => $date,
                    'label'  => $label,
                    'type'   => $type,
                    'amount' => $finance->amount,
                ]);
            });

    
        return $entries->groupBy('date')->map(function ($items) {
            return $items->groupBy('type')->map(function ($grouped) {
                return $grouped->map(fn ($item) => [
                    'label'  => $item['label'],
                    'amount' => $item['amount'],
                ])->values();
            });
        })->toArray();
    }    
}