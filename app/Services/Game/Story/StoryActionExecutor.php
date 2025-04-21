<?php

namespace App\Services\Game\Story;

use App\Models\Game\Player;
use App\Models\Game\PlayerStory;
use Illuminate\Support\Facades\DB;

class StoryActionExecutor
{
    protected Player $player;
    protected $story = null;
    protected ?string $lastChoiceText = null;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function execute($story, array $actions, ?string $choiceText = null): Player
    {
        $this->story = $story;
        $this->lastChoiceText = $choiceText;

        return DB::transaction(function () use ($actions) {
            foreach ($actions as $action) {
                match ($action->type) {
                    'increment_variable' => $this->incrementVariable($action),
                    'branch_to'          => $this->branchTo($action),
                    'end_story'          => $this->endStory(),
                    default              => null,
                };
            }

            return $this->player->fresh();
        });
    }

    public function parseText(string $text): string
    {
        return preg_replace_callback('/\{([\w\.]+)\}/', function ($matches) {
            return match ($matches[1]) {
                'player.nickname' => $this->player->nickname,
                'player.last_datetime' => $this->player->last_datetime,
                default       => $matches[0],
            };
        }, $text);
    }

    protected function incrementVariable($action): void
    {
        $field = $action->variable;
        $value = $action->value ?? 1;

        if (!array_key_exists($field, $this->player->getAttributes())) {
            throw new \InvalidArgumentException("Campo '{$field}' não existe no modelo Player.");
        }

        $this->player->{$field} += $value;
        $this->player->save();
    }


    protected function branchTo($action): void
    {
        PlayerStory::create([
            'player_id' => $this->player->id,
            'coid'      => $this->story->id,
            'date'      => $this->player->last_datetime,
            'choice'    => $this->lastChoiceText,
            'degration' => $this->player->degration,
            'water'     => $this->player->water,
            'amount'    => $this->player->amount,
        ]);

        $this->player->current_story = $action->target_id ?? null;
        $this->player->save();
    }

    protected function endStory(): void
    {
        PlayerStory::create([
            'player_id' => $this->player->id,
            'coid'      => $this->story->id,
            'date'      => $this->player->last_datetime,
            'choice'    => $this->lastChoiceText ?? 'end',
            'degration' => $this->player->degration,
            'water'     => $this->player->water,
            'amount'    => $this->player->amount,
        ]);

        $this->player->current_story = null;
        $this->player->finished = true;
        $this->player->finished_story = $this->story->id;
        $this->player->finished_choice = $this->lastChoiceText ?? 'end';
        $this->player->save();
    }
}