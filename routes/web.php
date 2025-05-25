<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\{UserHasPlayer, CheckPlayerTime};

use App\Http\Controllers\Auth\{GuestUserController, GoogleLoginController};
use App\Http\Controllers\General\ImageController;

use App\Livewire\Game\Player\{CreatePlayer, PlayerFinished};
use App\Livewire\Game\Explore\{ExploreManage};
use App\Livewire\Game\Finance\{FinanceManage, LoanManage};
use App\Livewire\Game\Inventory\{InventoryManage};
use App\Livewire\Game\Market\{MarketManage};
use App\Livewire\Game\People\{PeopleManage};
use App\Livewire\Game\Production\{ProductionManage, ProductionCreate, ProductionItem, ProductionAreaCrop};
use App\Livewire\Game\News\{Newspaper};
use App\Livewire\Game\Story\{EventsView};

use App\Livewire\General\Person\{PersonIndexPage, PersonFormPage};
use App\Livewire\General\Score\{RankingView};
use App\Livewire\General\{PreloadResources};

Route::view('/', 'welcome')->middleware(['throttle:10,1']);
Route::permanentRedirect('/login', '/');

Route::view('/credits', 'credits')->middleware(['throttle:10,1'])->name('credits');

Route::prefix('guest')->middleware(['throttle:10,1'])->controller(GuestUserController::class)->group(function () {
    Route::get('/create', 'create')->name('guest.create');
});

Route::controller(GoogleLoginController::class)->middleware(['throttle:10,1'])->group(function () {
    Route::get('/google/redirect', 'redirectToGoogle')->name('google.redirect');
    Route::get('/google/callback', 'handleGoogleCallback')->name('google.callback');
});

Route::middleware(['auth', UserHasPlayer::class, CheckPlayerTime::class, 'throttle:60,1'])->group(function () {
    Route::prefix('player')->group(function () {
        Route::get('/create', CreatePlayer::class)->name('player.create');
        Route::get('/finished', PlayerFinished::class)->name('player.finished');
    });

    Route::redirect('/dashboard', '/story/events');

    Route::prefix('people')->group(function () {
        Route::get('/manage', PeopleManage::class)->name('people.manage');
    });

    Route::prefix('explore')->group(function () {
        Route::get('/manage', ExploreManage::class)->name('explore.manage');
    });

    Route::prefix('market')->group(function () {
        Route::get('/manage', MarketManage::class)->name('market.manage');
    });

    Route::prefix('inventory')->group(function () {
        Route::get('/manage', InventoryManage::class)->name('inventory.manage');
    });

    Route::prefix('finance')->group(function () {
        Route::get('/manage', FinanceManage::class)->name('finance.manage');
        Route::get('/manage/loan', LoanManage::class)->name('finance.laon.manage');
    });

    Route::prefix('production')->group(function () {
        Route::get('/', ProductionManage::class)->name('production.manage');
        Route::get('/create', ProductionCreate::class)->name('production.create');
        Route::get('/item/i/{production:uuid?}', ProductionItem::class)->name('production.item');
        Route::get('/item/area/i/{production:uuid?}', ProductionAreaCrop::class)->name('production.area');
    });

    Route::prefix('news')->group(function () {
        Route::get('/newspaper', Newspaper::class)->name('news.newspaper');
    });

    Route::prefix('story')->group(function () {
        Route::get('/events', EventsView::class)->name('story.events');
    });

});

Route::middleware(['auth'])->group(function () {
    Route::prefix('i')->controller(ImageController::class)->group(function () {
        Route::get('/{path}', 'getImage')->name('get.image')->where('path', '.*'); 
    });
    
    Route::prefix('general')->middleware(['throttle:30,1'])->group(function () {
        Route::get('/preload', PreloadResources::class)->name('general.preload');

        Route::prefix('score')->group(function () {
            Route::get('/ranking', RankingView::class)->name('general.score.ranking');
        });

        Route::prefix('person')->group(function () {
            Route::get('/index', PersonIndexPage::class)->name('general.person.index');
            Route::get('/form', PersonFormPage::class)->name('general.person.form');
        });
    });
});   

Route::view('profile', 'profile')
    ->middleware(['auth', 'throttle:10,1'])
    ->name('profile');

require __DIR__.'/auth.php';
