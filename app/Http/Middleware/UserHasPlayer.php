<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Traits\LoadsPlayerFromSession;

class UserHasPlayer
{
    use LoadsPlayerFromSession;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $player = $this->getPlayerFromSession();

        if (!$player && !Route::is('player.create')) {
            return redirect()->route('player.create');
        }

        if (
            $player &&
            $player->finished &&
            !request()->routeIs('player.finished', 'player.create')
        ) {
            return redirect()->route('player.finished');
        }

        return $next($request);
    }
}