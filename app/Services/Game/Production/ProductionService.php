<?php

namespace App\Services\Game\Production;

use Illuminate\Support\Facades\DB;
use App\Models\Game\PlayerCharacter;
use App\Models\Game\PlayerProduction;
use App\Models\Game\PlayerAction;
use App\Models\Game\PlayerProduct;
use App\Traits\LoadsPlayerFromSession;
use Carbon\Carbon;
use App\Enums\TypeAreaProduction;
use App\Repositories\{ProductRepository, CropRepository};

class ProductionService
{
    use LoadsPlayerFromSession;

    public function createProduction(object $productionSetting, int $playerCharacterId, int $coid, TypeAreaProduction $typeArea = TypeAreaProduction::Breeding): bool|string
    {
        $result = DB::transaction(function () use ($productionSetting, $playerCharacterId, $coid, $typeArea) {
            $player = $this->getPlayerFromSession();

            if (!$player) {
                return 'Jogador não encontrado.';
            }

            $playerCharacter = PlayerCharacter::find($playerCharacterId);
            if (!$playerCharacter || $playerCharacter->player_id !== $player->id) {
                return 'Personagem inválido.';
            }

            if ($playerCharacter->working >= 3) {
                return 'Personagem está ocupado.';
            }

            if (
                $player->amount < abs($productionSetting->build['cost']) ||
                $player->water < abs($productionSetting->build['water'])
            ) {
                return 'Montante ou água insuficientes.';
            }

            $createdProducts = [];

            if (isset($productionSetting->build['products']['required']) && is_array($productionSetting->build['products']['required'])) {
                foreach ($productionSetting->build['products']['required'] as $requiredProduct) {
                    $currentBalance = PlayerProduct::where('player_id', $player->id)
                        ->where('coid', $requiredProduct->id)
                        ->selectRaw("SUM(CASE WHEN op = 'C' THEN amount ELSE -amount END) as balance")
                        ->value('balance');

                    if ($currentBalance < $requiredProduct->qnt) {
                        return 'Produtos insuficientes para a produção.';
                    }
                }

                foreach ($productionSetting->build['products']['required'] as $requiredProduct) {
                    $createdProducts[] = PlayerProduct::create([
                        'player_id'  => $player->id,
                        'coid'       => $requiredProduct->id,
                        'op'         => 'D',
                        'amount'     => $requiredProduct->qnt,
                        'unit_value' => 0,
                        'start'      => $player->last_datetime,
                        'end'        => $player->last_datetime,
                    ]);
                }
            }

            $player->amount    += $productionSetting->build['cost'];
            $player->water     += $productionSetting->build['water'];
            $player->area      += $productionSetting->build['area'];
            $player->degration += $productionSetting->build['degration'];
            $player->save();

            $playerCharacter->working++;
            $playerCharacter->save();

            $playerProduction = PlayerProduction::create([
                'player_id'            => $player->id,
                'player_character_id'  => $playerCharacterId,
                'coid'                 => $coid,
                'type_area'            => $typeArea,
                'start_build'          => $player->last_datetime,
                'end_build'            => Carbon::parse($player->last_datetime)->addHours($productionSetting->build['time']),
                'completed'            => false,
                'area'                 => $productionSetting->build['area'],
                'degration'            => $productionSetting->build['degration'],
                'water'                => $productionSetting->build['water'],
                'amount'               => $productionSetting->build['cost'],
            ]);

            foreach ($createdProducts as $product) {
                $product->update([
                    'player_production_id' => $playerProduction->id,
                ]);
            }

            return $player;
        });

        if (is_string($result)) {
            return $result;
        }

        $this->updatePlayerInSession($result->fresh(['playerCharacters']));

        return true;
    }


    public function createProductionAction(PlayerProduction $playerProduction, int $playerCharacterId, int $coid, int $typeArea = 0): bool|string
    {
        $result = DB::transaction(function () use ($playerProduction, $playerCharacterId, $coid, $typeArea) {
            $player = $this->getPlayerFromSession();

            if (!$player) {
                return 'Jogador não encontrado.';
            }

            $playerCharacter = PlayerCharacter::find($playerCharacterId);
            if (!$playerCharacter || $playerCharacter->player_id !== $player->id) {
                return 'Personagem inválido.';
            }

            if ($playerCharacter->working >= 3) {
                return 'Personagem está ocupado.';
            }

            $productionSetting = $playerProduction->game_data;

            if (
                $player->amount < abs($productionSetting->production['cost']) ||
                $player->water < abs($productionSetting->production['water'])
            ) {
                return 'Recursos insuficientes.';
            }

            $player->amount   += $productionSetting->production['cost'];
            $player->water    += $productionSetting->production['water'];
            $player->area     += $productionSetting->production['area'];
            $player->degration+= $productionSetting->production['degration'];
            $player->save();

            $playerCharacter->working++;
            $playerCharacter->save();

            PlayerAction::create([
                'player_id'            => $player->id,
                'player_production_id' => $playerProduction->id,
                'player_character_id'  => $playerCharacterId,
                'completed'            => false,
                'start'                => $player->last_datetime,
                'end'                  => Carbon::parse($player->last_datetime)->addHours($productionSetting->production['time']),
                'area'                 => $productionSetting->production['area'],
                'degration'            => $productionSetting->production['degration'],
                'water'                => $productionSetting->production['water'],
                'amount'               => $productionSetting->production['cost'],
            ]);

            return $player;
        });

        if (is_string($result)) {
            return $result;
        }

        $this->updatePlayerInSession($result->fresh(['playerCharacters']));

        return true;
    }

    public function createProductionAreaCrop(object $nativeCleaningSetting, int $playerCharacterId): bool|string{
        $result = DB::transaction(function () use ($nativeCleaningSetting, $playerCharacterId) {
            $player = $this->getPlayerFromSession();

            if (!$player) {
                return 'Jogador não encontrado.';
            }

            $playerCharacter = PlayerCharacter::find($playerCharacterId);
            if (!$playerCharacter || $playerCharacter->player_id !== $player->id) {
                return 'Personagem inválido.';
            }

            if ($playerCharacter->working >= 3) {
                return 'Personagem está ocupado.';
            }

            $cost  = abs($nativeCleaningSetting->execution['cost']);
            $water = abs($nativeCleaningSetting->execution['water']);

            if ($player->amount < $cost || $player->water < $water) {
                return 'Recursos insuficientes.';
            }

            $player->amount    -= $cost;
            $player->water     -= $water;
            $player->area      += $nativeCleaningSetting->execution['area'];
            $player->degration += $nativeCleaningSetting->execution['degration'];
            $player->save();

            $playerCharacter->working++;
            $playerCharacter->save();

            $playerProduction = PlayerProduction::create([
                'player_id'           => $player->id,
                'player_character_id' => $playerCharacterId,
                'native_cleaning_coid' => $nativeCleaningSetting->id,
                'type_area'           => TypeAreaProduction::Cultivation,
                'status_area'         => 1, 
                'start_build'         => $player->last_datetime,
                'end_build'           => Carbon::parse($player->last_datetime)->addHours($nativeCleaningSetting->execution['time']),
                'completed'           => false,
                'area'                => $nativeCleaningSetting->execution['area'],
                'degration'           => $nativeCleaningSetting->execution['degration'],
                'water'               => $nativeCleaningSetting->execution['water'],
                'amount'              => $nativeCleaningSetting->execution['cost'],
            ]);
            return $player;
        });

        if (is_string($result)) {
            return $result;
        }

        $this->updatePlayerInSession($result->fresh(['playerCharacters']));
        return true;
    }

    public function createProductionActionAreaCrop(PlayerProduction $playerProduction, int $playerCharacterId, int $coid, array $optionalSelected, int $cyclo): bool|string
    {
        $result = DB::transaction(function () use ($playerProduction, $playerCharacterId, $coid, $optionalSelected, $cyclo) {
            $player = $this->getPlayerFromSession();

            if (!$player) {
                return 'Jogador não encontrado.';
            }

            $playerCharacter = PlayerCharacter::find($playerCharacterId);
            if (!$playerCharacter || $playerCharacter->player_id !== $player->id) {
                return 'Personagem inválido.';
            }

            if ($playerCharacter->working >= 3) {
                return 'Personagem está ocupado.';
            }

            $cropData = app(CropRepository::class)->find($coid);
            if (!$cropData || !isset($cropData->production)) {
                return 'Cultivo inválido.';
            }

            $isFirstCycle = $cyclo === 1;
            $productionData = $isFirstCycle ? ($cropData->production['start_cycle'] ?? null) : ($cropData->production['continue_cycle'] ?? null);
            if (!$productionData) {
                return 'Dados de produção não encontrados para o ciclo atual.';
            }

            $cost  = abs($productionData['cost']);
            $water = abs($productionData['water']);

            if ($player->amount < $cost || $player->water < $water) {
                return 'Montante (R$) ou água insuficientes.';
            }

            $productRepository = app(ProductRepository::class);

            $parsedOptionals = collect($optionalSelected)->map(fn($json) => json_decode($json));

            $requiredProducts = collect($productionData['phases'] ?? [])
                ->flatMap(fn($phase) => $phase['products']['required'] ?? [])
                ->groupBy('id')
                ->map(function ($items) {
                    return [
                        'id' => $items->first()->id,
                        'qnt' => $items->sum('qnt')
                    ];
                })
                ->values();

            foreach ($requiredProducts as $required) {
                $balance = PlayerProduct::where('player_id', $player->id)
                    ->where('coid', $required['id'])
                    ->selectRaw("SUM(CASE WHEN op = 'C' THEN amount ELSE -amount END) as balance")
                    ->value('balance');

                if ($balance < $required['qnt']) {
                    return 'Produtos obrigatórios insuficientes.'.$required['id'];
                }
            }

            foreach ($parsedOptionals as $product) {
                $balance = PlayerProduct::where('player_id', $player->id)
                    ->where('coid', $product->id)
                    ->selectRaw("SUM(CASE WHEN op = 'C' THEN amount ELSE -amount END) as balance")
                    ->value('balance');

                if ($balance < $product->qnt) {
                    return 'Produtos opcionais insuficientes.'.$product->id;
                }
            }

            foreach ($requiredProducts as $required) {
                PlayerProduct::create([
                    'player_id'            => $player->id,
                    'player_production_id' => $playerProduction->id,
                    'coid'                 => $required['id'],
                    'op'                   => 'D',
                    'amount'               => $required['qnt'],
                    'unit_value'           => 0,
                    'start'                => $player->last_datetime,
                    'end'                  => $player->last_datetime,
                ]);
            }

            foreach ($parsedOptionals as $product) {
                PlayerProduct::create([
                    'player_id'            => $player->id,
                    'player_production_id' => $playerProduction->id,
                    'coid'                 => $product->id,
                    'op'                   => 'D',
                    'amount'               => $product->qnt,
                    'unit_value'           => 0,
                    'start'                => $player->last_datetime,
                    'end'                  => $player->last_datetime,
                ]);
            }

            $playerProduction->crop_coid = $coid;
            $playerProduction->save();

            $baseIncrease = $productionData['increase_production'] ?? 0;
            $baseDegration = $productionData['degration'] ?? 0;

            $optionalEffects = $parsedOptionals->reduce(function ($carry, $product) use ($productRepository) {
                $productData = $productRepository->find($product->id);
                $carry['increase'] += $productData->increase_production ?? 0;
                $carry['degration'] += $productData->degration ?? 0;
                return $carry;
            }, ['increase' => 0, 'degration' => 0]);

            $totalIncreaseProduction = $baseIncrease + $optionalEffects['increase'];
            $totalDegration = $baseDegration + $optionalEffects['degration'] + ($cropData->production['degration'] ?? 0);

            $player->amount -= $cost;
            $player->water -= $water;
            $player->degration += $totalDegration;
            $player->save();

            $playerCharacter->working++;
            $playerCharacter->save();

            PlayerAction::create([
                'player_id'            => $player->id,
                'player_production_id' => $playerProduction->id,
                'player_character_id'  => $playerCharacterId,
                'cycles'               => $cyclo,
                'coid_type'            => CropRepository::class,
                'coid'                 => $coid,
                'completed'            => false,
                'start'                => $player->last_datetime,
                'end'                  => Carbon::parse($player->last_datetime)->addHours($productionData['time']),
                'increase_production'  => $totalIncreaseProduction,
                'area'                 => $productionData['area'] ?? 0,
                'degration'            => $totalDegration,
                'water'                => -$water,
                'amount'               => -$cost,
            ]);

            return $player;
        });

        if (is_string($result)) {
            return $result;
        }

        $this->updatePlayerInSession($result->fresh(['playerCharacters']));
        return true;
    }

    protected function validatePlayerAndCharacter(Player $player, int $characterId): PlayerCharacter|string
    {
        $character = PlayerCharacter::find($characterId);

        if (!$character || $character->player_id !== $player->id) {
            return 'Personagem inválido.';
        }

        if ($character->working >= 3) {
            return 'Personagem está ocupado.';
        }

        return $character;
    }

    protected function validateResources(Player $player, float $cost, float $water): bool|string
    {
        if ($player->amount < $cost || $player->water < $water) {
            return 'Montante ou água insuficientes.';
        }

        return true;
    }

    protected function checkProductStock(Player $player, int $productId, int $requiredQnt): bool
    {
        $balance = PlayerProduct::where('player_id', $player->id)
            ->where('coid', $productId)
            ->selectRaw("SUM(CASE WHEN op = 'C' THEN amount ELSE -amount END) as balance")
            ->value('balance');

        return $balance >= $requiredQnt;
    }

    protected function debitProduct(Player $player, int $productionId, int $actionId = null, int $productId, int $qnt): void
    {
        PlayerProduct::create([
            'player_id'            => $player->id,
            'player_production_id' => $productionId,
            'player_action_id' => $actionId,
            'coid'                 => $productId,
            'op'                   => 'D',
            'amount'               => $qnt,
            'unit_value'           => 0,
            'start'                => $player->last_datetime,
            'end'                  => $player->last_datetime,
        ]);
    }

    protected function applyPlayerResourceChanges(Player $player, float $cost, float $water, float $area = 0, float $degration = 0): void
    {
        $player->amount -= $cost;
        $player->water -= $water;
        $player->area += $area;
        $player->degration += $degration;
        $player->save();
    }

    protected function incrementCharacterWorkload(PlayerCharacter $character): void
    {
        $character->working++;
        $character->save();
    }

}