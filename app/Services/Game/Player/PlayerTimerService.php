<?php

namespace App\Services\Game\Player;

use App\Models\Game\Player;
use Carbon\Carbon;
use Session;

class PlayerTimerService
{
    protected Player $player;
    protected Carbon $now;
    protected int $realSecondsPassed;

    public function setPlayer(Player $player): self
    {
        $this->player = $player;
        return $this;
    }

    public function setNow(Carbon $now): self
    {
        $this->now = $now;
        return $this;
    }

    public function updatePlayerTime(): Player
    {
        $this->updateTime();

        switch ($this->player->mode_time) {
            case 1:
                $this->updateModePrimary();
                break;
            case 2:
                $this->updateModeSecondary();
                break;
        }

        $this->player->last_execution = $this->now;
        $this->player->save();
        return $this->player;
    }

    private function updateTime(): void
    {
        $this->realSecondsPassed = $this->getRealSecondsPassed();
    }

    private function updateModePrimary(): void
    {
        $this->player->last_datetime = Carbon::parse($this->player->last_datetime)->addHours($this->realSecondsPassed);
    }

    private function updateModeSecondary(): void
    {
        $this->player->last_datetime = Carbon::parse($this->player->last_datetime)->addDays($this->realSecondsPassed);
    }

    private function getRealSecondsPassed(): int
    {
        $lastExecution = Carbon::parse($this->player->last_execution ?? $this->player->updated_at);
        return $lastExecution->diffInSeconds($this->now);
    }
}
