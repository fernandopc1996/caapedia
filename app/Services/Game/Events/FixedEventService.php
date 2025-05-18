<?php

namespace App\Services\Game\Events;

use App\Models\Game\Player;
use App\Services\Game\Events\Rules\AddCharacter;
use App\Services\Game\Events\Rules\EndGameByResources;

class FixedEventService
{
    protected Player $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function process(): void
    {
        app(AddCharacter::class)->handle($this->player);
        app(EndGameByResources::class)->handle($this->player);

        //app(\App\Services\Game\Events\Rules\StartStoryIfLevelReached::class)->handle($this->player);

    }
}
