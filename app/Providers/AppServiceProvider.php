<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

use Illuminate\Support\Facades\Gate;
use App\Support\AclPermissions;
use App\Enums\UserRole;
use App\Models\User;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Repositories\CharacterRepository::class);
        $this->app->singleton(\App\Repositories\ProductRepository::class);
        $this->app->singleton(\App\Repositories\ProductionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('format', function ($expression) {
            return "<?php echo \App\Helpers\Formatter::formatNumber($expression); ?>";
        });

        foreach ($this->getAllPermissions() as $permission) {
            Gate::define($permission, function (User $user) use ($permission) {
                return $user->hasPermission($permission);
            });
        }
    }

    protected function getAllPermissions(): array
    {
        return collect([
            UserRole::Player,
            UserRole::Moderator,
            UserRole::Administrator,
        ])
        ->flatMap(fn($role) => AclPermissions::permissions($role))
        ->unique()
        ->values()
        ->all();
    }
}
