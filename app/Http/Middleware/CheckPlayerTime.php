<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Game\Player\PlayerTimerService;
use Carbon\Carbon;
use Session;

use App\Traits\LoadsPlayerFromSession;

class CheckPlayerTime{
    
    use LoadsPlayerFromSession;

    protected PlayerTimerService $playerTimerService;

    public function __construct(PlayerTimerService $playerTimerService)
    {
        $this->playerTimerService = $playerTimerService;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $now = now(); 
        $playerInit = $this->getPlayerFromSession();

        if ($playerInit && $playerInit->mode_time != 0) {
            $player = $this->playerTimerService
                ->setNow($now)
                ->setPlayer($playerInit)
                ->updatePlayerTime();

            $this->updatePlayerInSession($player);
        }

        return $next($request);
    }
}
