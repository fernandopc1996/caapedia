<?php

namespace App\Jobs\Events;

use App\Models\Game\Player;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;

use App\Services\Game\Finance\LoanInstallmentService;
use App\Services\Game\Finance\FamilyCostService;
use App\Services\Game\Mechanics\PlayerRateAdjustmentService;
use App\Services\Game\Events\PlayerEventProcessorService;
use App\Services\Game\Events\FixedEventService;

class ProcessPlayerEvent implements ShouldQueue
{
    use Queueable;

    protected int $playerId;
    protected Carbon $simulatedDate;

    public $uniqueFor = 3600;

    protected ?Carbon $previousDate = null;

    public function __construct(int $playerId, string $simulatedDate, ?string $previousDate = null)
    {
        $this->playerId = $playerId;
        $this->simulatedDate = Carbon::parse($simulatedDate)->startOfDay();
        $this->previousDate = $previousDate ? Carbon::parse($previousDate)->startOfDay() : null;
    }

    public function uniqueId(): string
    {
        return "player_event_{$this->playerId}";
    }

    public function middleware(): array
    {
        return [
            (new WithoutOverlapping($this->uniqueId()))->dontRelease(),
        ];
    }

    public function handle(): void
    {
        $player = Player::find($this->playerId);
        if (!$player) return;

        app(PlayerEventProcessorService::class)
        ->process($player, $this->simulatedDate, $this->previousDate);
    }

}
