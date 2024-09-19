<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class UserHasPlayer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if ($user->players()->count() === 0 and !Route::is('player.create')) {
            return redirect()->route('player.create');
        }
        if ($request->session()->missing('player')) {
            $request->session()->put('player', $user->players()->first());
        }
       
        return $next($request);
    }

    
}
