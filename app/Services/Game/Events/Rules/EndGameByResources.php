<?php

namespace App\Services\Game\Events\Rules;

use App\Models\Game\Player;
use App\Models\Game\PlayerStory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EndGameByResources
{
    protected array $rules = [
        [
            'param' => 'amount',
            'threshold' => -10000,
            'story_id' => 9999,
        ],
        [
            'param' => 'amount',
            'threshold' => 0,
            'story_id' => 9000,
        ],
    ];

    public function handle(Player $player): void
    {
        $now = now();

        foreach ($this->rules as $rule) {
            $value = $player->{$rule['param']};

            $alreadyTriggered = PlayerStory::where('player_id', $player->id)
                ->where('coid_type', \App\Repositories\StoryRepository::class)
                ->where('coid', $rule['story_id'])
                ->exists();

            if ($value < $rule['threshold'] && !$alreadyTriggered) {
                DB::transaction(function () use ($player, $now, $rule) {

                    $player->current_story = $rule['story_id'];

                    if ($player->mode_time !== 0) {
                        $previousMode = $player->mode_time; 
                        $player->mode_time = 0;

                        $lastExecution = Carbon::parse($player->last_execution ?? $player->updated_at);
                        $realSecondsPassed = $lastExecution->diffInSeconds($now);

                        switch ($previousMode) {
                            case 1:
                                $player->last_datetime = Carbon::parse($player->last_datetime)->addHours($realSecondsPassed);
                                break;
                            case 2:
                                $player->last_datetime = Carbon::parse($player->last_datetime)->addDays($realSecondsPassed);
                                break;
                        }
                    }

                    $player->last_execution = $now;
                    $player->save();
                });

                return;
            }
        }
    }
}