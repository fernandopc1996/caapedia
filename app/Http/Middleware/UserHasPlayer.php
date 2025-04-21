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
            return redirect('/');
        }

        $user = Auth::user();

        if (!$request->session()->has('player')) {
            $request->session()->put('player', $user->players()->orderBy('created_at', 'desc')->first());
        }

        if ($request->session()->get('player') == null and !Route::is('player.create')) {
            return redirect()->route('player.create');
        }

        if($request->session()->has('player') && $request->session()->get('player')->finished == true && !Route::is('player.finished') && !Route::is('player.create')){
            return redirect()->route('player.finished');
        }
       
        return $next($request);
    }

    
}
