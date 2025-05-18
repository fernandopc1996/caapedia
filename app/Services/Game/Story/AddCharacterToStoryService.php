<?php

namespace App\Services\Game\Story;

use App\Models\Game\Player;
use App\Models\Game\PlayerCharacter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AddCharacterToStoryService
{
    protected array $characters = [
        ['character_id' => 3, 'story_start_id' => 8000, 'min_year' => 1996],
        ['character_id' => 4, 'story_start_id' => 8500, 'min_year' => 1998],
    ];

    public function execute(Player $player): void
    {
        DB::transaction(function () use ($player) {
            $year = Carbon::parse($player->last_datetime)->year;

            foreach ($this->characters as $char) {
                $alreadyHas = PlayerCharacter::where('player_id', $player->id)
                    ->where('coid', $char['character_id'])
                    ->exists();

                if (!$alreadyHas && $year >= $char['min_year']) {
                    PlayerCharacter::create([
                        'player_id' => $player->id,
                        'coid' => $char['character_id'],
                        'working' => false,
                    ]);

                    $player->update([
                        'current_story' => $char['story_start_id'],
                    ]);

                    return; 
                }
            }
        });
    }
}
