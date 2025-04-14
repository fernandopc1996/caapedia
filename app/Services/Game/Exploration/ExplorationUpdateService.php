<?php

namespace App\Services\Game\Exploration;

use App\Models\Game\Player;
use App\Models\Game\PlayerProduct;
use Illuminate\Support\Facades\DB;
use App\Services\Game\Mechanics\WeightedRandomPicker;
use App\Repositories\ExplorationRepository;

class ExplorationUpdateService
{
    public function handle(Player $player): bool
    {
        $now = $player->last_datetime;
        $wasUpdated = false;

        $actions = $player->playerActions()
            ->where('coid_type', ExplorationRepository::class)
            ->where('completed', false)
            ->where('end', '<=', $now)
            ->get();

        foreach ($actions as $action) {
            $changed = DB::transaction(function () use ($player, $action) {
                $action->completed = true;
                $action->save();

                $action->playerCharacter->working -= 1;
                $action->playerCharacter->save();

                $this->createProductsFromExploration($player, $action);
                return true;
            });

            if ($changed) {
                $wasUpdated = true;
            }
        }

        return $wasUpdated;
    }

    private function createProductsFromExploration(Player $player, $action): void
    {
        $exploration = app(ExplorationRepository::class)->find($action->coid);

        if (!$exploration || empty($exploration->exploration['products'])) {
            return;
        }

        $productsConfig = $exploration->exploration['products'];
        $batch = $exploration->exploration['batch'] ?? 1;

        $grouped = $this->generateGroupedProducts($productsConfig, $batch);

        foreach ($grouped as $data) {
            PlayerProduct::create([
                'player_id'        => $player->id,
                'coid'             => $data['product']->id,
                'amount'           => $data['amount'],
                'op'               => 'C',
                'start'            => $action->start,
                'end'              => $action->end,
                'player_action_id' => $action->id,
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
