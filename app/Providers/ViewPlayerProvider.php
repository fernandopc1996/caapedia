<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Models\Game\Player;
use App\Traits\LoadsPlayerFromSession;

class ViewPlayerProvider extends ServiceProvider
{
    use LoadsPlayerFromSession;

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $player = $this->getPlayerFromSession();
            $view->with('player', $player);
        });
    }
}