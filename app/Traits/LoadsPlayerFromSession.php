<?php

namespace App\Traits;

use App\Models\Game\Player;
use Illuminate\Support\Facades\Session;

trait LoadsPlayerFromSession
{
    public function getPlayerFromSession(): ?Player
    {
        if (Session::has('player')) {
            return Session::get('player');
        }

        $user = auth()->user();
        if (!$user) {
            return null;
        }

        return $user->players()->first();
    }

    public function updatePlayerInSession(Player $player): void
    {
        $player->fresh([
            'playerCharacters',
        ]);
        Session::put('player', $player);
    }
}
