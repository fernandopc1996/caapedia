<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\{UserHasPlayer, CheckPlayerTime};

use App\Http\Controllers\Auth\GuestUserController;

use App\Livewire\Game\Player\{CreatePlayer};



Route::view('/', 'welcome');

Route::prefix('guest')->controller(GuestUserController::class)->group(function () {
    Route::get('/create', 'create')->name('guest.create');
});

Route::middleware(['auth', UserHasPlayer::class])->group(function () {
    Route::prefix('player')->group(function () {
        Route::get('/create', CreatePlayer::class)->name('player.create');
    });

    Route::middleware([CheckPlayerTime::class])->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');

    });
    
});



Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
