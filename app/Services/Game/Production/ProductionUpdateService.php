<?php

namespace App\Services\Game\Production;

use App\Models\Game\Player;
use App\Models\Game\PlayerProduct;
use Illuminate\Support\Facades\DB;

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

                //$this->createProducts($player, $action->playerCharacter, null, $action);
                return true;
            });

            if ($changed) {
                $wasUpdated = true;
            }
        }

        return $wasUpdated;
    }

    private function createProducts(Player $player, $character, $production = null, $action = null): void
    {
        if (!$character || !$character->game_data?->products) return;

        foreach ($character->game_data->products as $product) {
            PlayerProduct::create([
                'player_id' => $player->id,
                'coid' => $product->coid,
                'op' => $product->op ?? 'default',
                'amount' => $product->amount ?? 1,
                'player_action_id' => $action?->id,
                'player_production_id' => $production?->id,
            ]);
        }
    }
}
