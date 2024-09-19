<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Carbon\Carbon;

class CheckPlayerTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{
        $player = auth()->user()->players()->first();
        
        if ($player->mode_time == 0) {
            return $next($request);
        }

        $lastExecution = Carbon::parse($player->last_execution ?? $player->updated_at); 
        $now = Carbon::now();

        // Calcula a diferença em segundos entre as duas datas
        $realSecondsPassed = $lastExecution->diffInSeconds($now);

        // Se o modo for 1, cada segundo real incrementa 1 hora
        if ($player->mode_time == 1) {
            $player->last_datetime = Carbon::parse($player->last_datetime)->addHours($realSecondsPassed);
        }

        // Se o modo for 2, cada segundo real incrementa 1 dia
        if ($player->mode_time == 2) {
            $player->last_datetime = Carbon::parse($player->last_datetime)->addDays($realSecondsPassed);
        }
        $player->last_execution = $now;
        $player->save();

        $request->session()->put('player', $player);
        return $next($request);
    }
}
