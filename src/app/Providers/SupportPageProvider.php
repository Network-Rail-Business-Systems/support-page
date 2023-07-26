<?php

namespace Networkrailbusinesssystems\SupportPage\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Networkrailbusinesssystems\SupportPage\Http\Controllers\Support\SupportController;
use Networkrailbusinesssystems\SupportPage\Http\Controllers\Support\SupportDetailController;

class SupportPageProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->addPermission();
        $this->bootPublishes();
        $this->bootRoutes();
        $this->bootViews();
    }

    protected function bootPublishes(): void
    {
        $this->publishes([
            __DIR__.'/../../resources/views/errors' => resource_path('views/errors'),
            __DIR__.'/../../resources/views/components' => resource_path('views/components'),
            __DIR__.'/../../resources/views/support' => resource_path('views/support'),
            __DIR__.'/../../resources/views/admin.blade.php' => resource_path('views/admin.blade.php'),
        ]);
    }

    protected function bootRoutes(): void
    {
        Route::prefix('/support')
            ->name('support')
            ->controller(SupportController::class)
            ->group(function () {
                Route::get('/', 'support');
                Route::get('/owner-team/{role}', 'owners')->name('.owners');
            });

        Route::prefix('/support-details')
            ->name('support-details.')
            ->controller(SupportDetailController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/delete/{supportDetail}', 'delete')->name('delete');
            });
    }

    protected function bootViews(): void
    {
        $this->loadViewsFrom(
            __DIR__.'/../../resources/views',
            'support-page'
        );
    }

    protected function addPermission(): array
    {
        $permissions = config('support-page.update.permissions')::PERMISSIONS;
        $permissions['manage_support_page'] = [config('support-page.update.permissions')::ADMIN];

        return $permissions;
    }

    //admin blade - need to add manage support page section
}
