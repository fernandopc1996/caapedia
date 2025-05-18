<?php

namespace App\Services\Game\Events\Rules;

use App\Models\Game\Player;
use Illuminate\Support\Carbon;
use App\Services\Game\Story\AddCharacterToStoryService;

class AddCharacter
{
    protected int $maxCharactersAvailable = 5;

    public function handle(Player $player): void
    {
        if (!$player->relationLoaded('playerCharacters')) {
            $player->load('playerCharacters');
        }

        if ($player->playerCharacters->count() >= $this->maxCharactersAvailable) {
            return;
        }

        $year = Carbon::parse($player->last_datetime)->year;
        if ($year <= 1995) {
            return;
        }

        if (random_int(1, 100) > 10) {
            return;
        }

        app(AddCharacterToStoryService::class)->execute($player);
    }
}
