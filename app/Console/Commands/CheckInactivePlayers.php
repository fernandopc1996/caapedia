<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\Game\Player;
use App\Jobs\Events\ProcessMultiplePlayerEvents;

class CheckInactivePlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'caapedia:check-inactive-players';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica jogadores inativos, pausa o tempo e processa eventos pendentes';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $now = now();

        $players = Player::whereIn('mode_time', [1, 2])
            ->where(function ($query) use ($now) {
                $query->where(function ($q) use ($now) {
                    $q->where('mode_time', 1)
                      ->where('updated_at', '<=', $now->copy()->subHours(2));
                })->orWhere(function ($q) use ($now) {
                    $q->where('mode_time', 2)
                      ->where('updated_at', '<=', $now->copy()->subHour());
                });
            })
            ->pluck('id')
            ->toArray();

        if (!empty($players)) {
            ProcessMultiplePlayerEvents::dispatch($players, $now, true);
            $this->info(count($players) . " jogadores inativos enviados para processamento.");
        } else {
            $this->info("Nenhum jogador inativo encontrado.");
        }
    }
}