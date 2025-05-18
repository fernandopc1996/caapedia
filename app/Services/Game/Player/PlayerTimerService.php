<?php

namespace App\Services\Game\Player;

use App\Models\Game\Player;
use App\Jobs\Events\ProcessPlayerEvent;
use App\Enums\TypeEvent;
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

        $previousDatetime = Carbon::parse($this->player->last_datetime);

        switch ($this->player->mode_time) {
            case 1:
                $this->updateModePrimary();
                break;
            case 2:
                $this->updateModeSecondary();
                break;
        }

        $currentDatetime = Carbon::parse($this->player->last_datetime);
        ProcessPlayerEvent::dispatch($this->player->id, $currentDatetime->toDateTimeString(), $previousDatetime->toDateTimeString());
        //$this->checkAndDispatchEvents($previousDatetime, $currentDatetime);

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

    private function checkAndDispatchEvents(Carbon $before, Carbon $after): void
    {
        if ($before->month !== $after->month || $before->year !== $after->year) {
            ProcessPlayerEvent::dispatch($this->player->id, TypeEvent::Monthly, $after->toDateTimeString());
        }

        if ($before->year !== $after->year) {
            ProcessPlayerEvent::dispatch($this->player->id, TypeEvent::Yearly, $after->toDateTimeString());
        }

        if (random_int(1, 100) === 1) {
            ProcessPlayerEvent::dispatch($this->player->id, TypeEvent::Random, $after->toDateTimeString());
        }
    }
}