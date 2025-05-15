<?php

namespace App\Traits;

use App\Models\Game\Player;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

trait LoadsPlayerFromSession
{
    public function getPlayerFromSession(): ?Player
    {
        if (!Session::has('player_id')) {
            $user = auth()->user();
            if (!$user) return null;

            $player = $user->players()->first();
            if (!$player) return null;

            Session::put('player_id', $player->id);
        }

        $playerId = Session::get('player_id');
        return $this->getCachedPlayer($playerId);
    }

    public function updatePlayerInSession(Player $player, bool $new = false): void
    {
        if ($new) {
            Session::forget('player_id');
        }

        Session::put('player_id', $player->id);

        $player = $player->fresh(['playerCharacters']);
        $this->cachePlayer($player);
    }

    protected function getCachedPlayer(int $playerId): ?Player
    {
        $latestTimestamp = Cache::get("player:{$playerId}:latest");

        if (!$latestTimestamp) {
            $player = Player::with('playerCharacters')->find($playerId);
            if (!$player) return null;

            $this->cachePlayer($player);
            return $player;
        }

        $cacheKey = "player:{$playerId}:{$latestTimestamp}";

        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($playerId) {
            return Player::with('playerCharacters')->find($playerId);
        });
    }


    protected function cachePlayer(Player $player): void
    {
        $timestamp = $player->updated_at->timestamp;

        Cache::put("player:{$player->id}:latest", $timestamp, now()->addMinutes(10));

        Cache::put("player:{$player->id}:{$timestamp}", $player, now()->addMinutes(10));
    }
}
