<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\{UserHasPlayer, CheckPlayerTime};

use App\Http\Controllers\Auth\GuestUserController;

use App\Livewire\Game\Player\{CreatePlayer};
use App\Livewire\Game\Explore\{ExploreManage};
use App\Livewire\Game\Finance\{FinanceManage};
use App\Livewire\Game\Inventory\{InventoryManage};
use App\Livewire\Game\Market\{MarketManage};
use App\Livewire\Game\People\{PeopleManage};
use App\Livewire\Game\Production\{ProductionManage};
use App\Livewire\Game\News\{Newspaper};

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

        Route::prefix('people')->group(function () {
            Route::get('/manage', PeopleManage::class)->name('people.manage');
        });

        Route::prefix('explore')->group(function () {
            Route::get('/manage', ExploreManage::class)->name('explore.manage');
        });

        Route::prefix('market')->group(function () {
            Route::get('/manage', CreatePlayer::class)->name('market.manage');
        });

        Route::prefix('inventory')->group(function () {
            Route::get('/manage', InventoryManage::class)->name('inventory.manage');
        });

        Route::prefix('finance')->group(function () {
            Route::get('/manage', FinanceManage::class)->name('finance.manage');
        });

        Route::prefix('production')->group(function () {
            Route::get('/manage', ProductionManage::class)->name('production.manage');
        });

        Route::prefix('news')->group(function () {
            Route::get('/newspaper', Newspaper::class)->name('news.newspaper');
        });
    });
    
});



Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
