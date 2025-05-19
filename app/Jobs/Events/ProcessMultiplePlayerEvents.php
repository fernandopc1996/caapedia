<?php

namespace App\Jobs\Events;

use App\Models\Game\Player;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\Game\Events\PlayerEventProcessorService;

class ProcessMultiplePlayerEvents implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $playerIds;
    protected Carbon $now;
    protected bool $shouldPause;

    public function __construct(array $playerIds, ?Carbon $now = null, bool $shouldPause = true)
    {
        $this->playerIds = $playerIds;
        $this->now = $now ?? now();
        $this->shouldPause = $shouldPause;
    }

    public function handle(): void
    {
        $service = app(PlayerEventProcessorService::class);

        $players = Player::whereIn('id', $this->playerIds)->get();

        foreach ($players as $player) {
            $originalMode = $player->getOriginal('mode_time');

            $lastDatetime = Carbon::parse($player->last_datetime);
            $lastExecution = Carbon::parse($player->last_execution ?? $player->updated_at);
            $realSecondsPassed = $lastExecution->diffInSeconds($this->now);

            // Atualiza tempo simulado
            switch ($originalMode) {
                case 1:
                    $player->last_datetime = $lastDatetime->addHours($realSecondsPassed);
                    break;
                case 2:
                    $player->last_datetime = $lastDatetime->addDays($realSecondsPassed);
                    break;
            }

            if ($this->shouldPause) {
                $player->mode_time = 0;
            }

            $player->last_execution = $this->now;
            $player->save();

            $service->process($player, $player->last_datetime, $lastExecution);
        }
    }
}