<?php

namespace App\Services\Game\Story;

use App\Models\Game\Player;

class StoryActionExecutor
{
    protected Player $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function execute(array $actions): void
    {
        foreach ($actions as $action) {
            match ($action['type']) {
                'increment_variable' => $this->incrementVariable($action),
                'branch_to'          => $this->branchTo($action),
                'end_story'          => $this->endStory(),
                default              => null,
            };
        }
    }

    public function parseText(string $text): string
    {
        return preg_replace_callback('/\{([\w\.]+)\}/', function ($matches) {
            return match ($matches[1]) {
                'player.name' => $this->player->nickname,
                default       => $matches[0],
            };
        }, $text);
    }

    protected function incrementVariable(array $action): void
    {
        $this->player->setVariable(
            $action['variable'],
            $this->player->getVariable($action['variable']) + $action['value']
        );
    }

    protected function branchTo(array $action): void
    {
        $this->player->story_position = $action['target_id'];
        $this->player->save();
    }

    protected function endStory(): void
    {
        $this->player->story_position = null;
        $this->player->save();
    }
}