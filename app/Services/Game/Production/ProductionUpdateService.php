<?php

namespace App\Services\Game\Production;

use App\Models\Game\Player;
use App\Models\Game\PlayerProduct;
use Illuminate\Support\Facades\DB;

use App\Services\Game\Mechanics\WeightedRandomPicker;

class ProductionUpdateService
{
    public function handle(Player $player): bool
    {
        $now = $player->last_datetime;
        $wasUpdated = false;

        // Processa produções finalizadas
        $productions = $player->playerProductions()
            ->where('completed', false)
            ->where('end_build', '<=', $now)
            ->get();

        foreach ($productions as $production) {
            $changed = DB::transaction(function () use ($player, $production) {
                $production->completed = true;
                $production->save();

                $production->playerCharacter->working -= 1;
                $production->playerCharacter->save();

                if ($production->type_area === \App\Enums\TypeAreaProduction::Cultivation) {
                    $this->createProductsFromNativeCleaning($player, $production);
                }

                return true;
            });

            if ($changed) {
                $wasUpdated = true;
            }
        }

        // Processa ações
        $actions = $player->playerActions()
            ->where('completed', false)
            ->where('end', '<=', $now)
            ->get();

        foreach ($actions as $action) {
            $changed = DB::transaction(function () use ($player, $action) {
                $action->completed = true;
                $action->save();

                $action->playerCharacter->working -= 1;
                $action->playerCharacter->save();

                $this->createProductsFromProductionAction($player, $action->playerProduction, $action);
                return true;
            });

            if ($changed) {
                $wasUpdated = true;
            }
        }

        return $wasUpdated;
    }

    private function createProductsFromProductionAction(Player $player, $production = null, $action = null): void
    {
        $productionData = $production->crop_data ?? $production->game_data;

        if (!isset($productionData->production)) {
            return;
        }

        $config = $productionData->production;
        $productsConfig = $config['products'] ?? [];
        $batch = $config['batch'] ?? 1;

        if (empty($productsConfig)) {
            return;
        }

        $grouped = $this->generateGroupedProducts($productsConfig, $batch);

        $increase = $action?->increase_production ?? 0; 
        $degration = $action?->degration ?? 0;
        $factor = 1 + $increase - $degration;

        foreach ($grouped as $data) {
            $finalAmount = max(1, (int) round($data['amount'] * $factor));

            PlayerProduct::create([
                'player_id'            => $player->id,
                'coid'                 => $data['product']->id,
                'amount'               => $finalAmount,
                'op'                   => 'C',
                'start'                => $action?->start,
                'end'                  => $action?->end,
                'player_action_id'     => $action?->id,
                'player_production_id' => $production?->id,
            ]);
        }
    }



    private function createProductsFromNativeCleaning(Player $player, $production): void
    {
        $cleaning = $production->native_cleaning_data;

        if (empty($cleaning?->execution['products'])) {
            return;
        }

        $productsConfig = $cleaning->execution['products'];
        $batch = $cleaning->execution['batch'] ?? 1;

        $grouped = $this->generateGroupedProducts($productsConfig, $batch);

        foreach ($grouped as $data) {
            PlayerProduct::create([
                'player_id'            => $player->id,
                'coid'                 => $data['product']->id,
                'amount'               => $data['amount'],
                'op'                   => 'C',
                'start'                => $production->start_build,
                'end'                  => $production->end_build,
                'player_production_id' => $production->id,
            ]);
        }
    }

    private function generateGroupedProducts(array $productsConfig, int $batch): array
    {
        $productMapping = [];
        $weightMapping = [];

        foreach ($productsConfig as $product) {
            $productMapping[$product->id] = $product;
            $weightMapping[$product->id] = $product->lottery ?? 100;
        }

        $picker = new WeightedRandomPicker($weightMapping);
        $grouped = [];

        for ($i = 0; $i < $batch; $i++) {
            $selectedId = $picker->pick();
            $selectedProduct = $productMapping[$selectedId];

            $min = $selectedProduct->qnt[0] ?? 1;
            $max = $selectedProduct->qnt[1] ?? 1;
            $amount = mt_rand($min, $max);

            if (isset($grouped[$selectedId])) {
                $grouped[$selectedId]['amount'] += $amount;
            } else {
                $grouped[$selectedId] = [
                    'product' => $selectedProduct,
                    'amount'  => $amount,
                ];
            }
        }

        return $grouped;
    }

}
