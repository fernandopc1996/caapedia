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

        // Processa produções
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
                //$this->createProducts($player, $production->playerCharacter, $production, null);
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

                $this->createProducts($player, $action->playerProduction, $action);
                return true;
            });

            if ($changed) {
                $wasUpdated = true;
            }
        }

        return $wasUpdated;
    }

    private function createProducts(Player $player, $production = null, $action = null): void
    {   
        if (!isset($production->game_data->production)) {
            return;
        }
        
        $productionConfig = $production->game_data->production;
        $batch = $productionConfig['batch'] ?? 1;
        $productsConfig = $productionConfig['products'] ?? [];

        if (empty($productsConfig)) {
            return;
        }

        $productMapping = [];
        $weightMapping = [];
        foreach ($productsConfig as $product) {
            $productMapping[$product->id] = $product;
            $weightMapping[$product->id] = $product->lottery;
        }

        $picker = new WeightedRandomPicker($weightMapping);

        for ($i = 0; $i < $batch; $i++) {
            $selectedId = $picker->pick();
            $selectedProduct = $productMapping[$selectedId];

            $min = $selectedProduct->qnt[0] ?? 1;
            $max = $selectedProduct->qnt[1] ?? 1;
            $amount = mt_rand($min, $max);

            PlayerProduct::create([
                'player_id' => $player->id,
                'coid' => $selectedProduct->id,
                'op' => 'C', 
                'amount' => $amount,
                'player_action_id' => $action?->id,
                'player_production_id' => $production?->id,
            ]);
        }
    }

}
