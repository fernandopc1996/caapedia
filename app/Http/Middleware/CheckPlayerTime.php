<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Game\Player\PlayerTimerService;
use Carbon\Carbon;
use Session;

class CheckPlayerTime
{
    protected PlayerTimerService $playerTimerService;

    public function __construct(PlayerTimerService $playerTimerService)
    {
        $this->playerTimerService = $playerTimerService;
    }

    public function handle(Request $request, Closure $next): Response{
        $now = Carbon::now(); 
        $playerInit = $this->getPlayerFromSession();
        if ($playerInit) {
            $player = $this->playerTimerService
                            ->setNow($now)
                            ->setPlayer($playerInit)
                            ->updatePlayerTime();

            $this->updatePlayerInSession($player);
        }

        return $next($request);
    }

    private function getPlayerFromSession(){
        if (Session::has('player')) {
            return Session::get('player');
        }
        $player = auth()->user()->players()->first();
        return $player;
    }

    private function updatePlayerInSession($player): void{
        Session::put('player', $player);
    }
}
