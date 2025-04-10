<?php

namespace App\Services\Game\Production;

use Illuminate\Support\Facades\DB;
use App\Models\Game\PlayerCharacter;
use App\Models\Game\PlayerProduction;
use App\Models\Game\PlayerAction;
use App\Models\Game\PlayerProduct;
use App\Traits\LoadsPlayerFromSession;
use Carbon\Carbon;

class ProductionService
{
    use LoadsPlayerFromSession;

    public function createProduction(object $productionSetting, int $playerCharacterId, int $coid, int $typeArea = 0): bool|string
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



}