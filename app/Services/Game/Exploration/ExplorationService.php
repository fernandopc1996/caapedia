<?php

namespace App\Services\Game\Exploration;

use Illuminate\Support\Facades\DB;
use App\Models\Game\Player;
use App\Models\Game\PlayerCharacter;
use App\Models\Game\PlayerAction;
use App\Repositories\ExplorationRepository;
use App\Traits\LoadsPlayerFromSession;
use Carbon\Carbon;

class ExplorationService
{
    use LoadsPlayerFromSession;

    public function initExplorationAction(int $coid, int $playerCharacterId): bool|string
    {
        $result = DB::transaction(function () use ($coid, $playerCharacterId) {
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

            $exploration = app(ExplorationRepository::class)->find($coid);
            if (!$exploration || !isset($exploration->exploration)) {
                return 'Exploração inválida.';
            }

            $cost = abs($exploration->exploration['cost']);
            $water = abs($exploration->exploration['water']);

            if ($player->amount < $cost || $player->water < $water) {
                return 'Montante ou água insuficientes.';
            }

            $player->amount -= $cost;
            $player->water -= $water;
            $player->degration += $exploration->exploration['degration'] ?? 0;
            $player->save();

            $playerCharacter->working++;
            $playerCharacter->save();

            PlayerAction::create([
                'player_id'           => $player->id,
                'player_character_id' => $playerCharacterId,
                'coid_type'           => ExplorationRepository::class,
                'coid'                => $coid,
                'completed'           => false,
                'start'               => $player->last_datetime,
                'end'                 => Carbon::parse($player->last_datetime)->addHours($exploration->exploration['time']),
                'area'                => $exploration->exploration['area'] ?? 0,
                'degration'           => $exploration->exploration['degration'] ?? 0,
                'water'               => -$water,
                'amount'              => -$cost,
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
