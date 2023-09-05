<?php

namespace NetworkRailBusinessSystems\SupportPage\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use NetworkRailBusinessSystems\SupportPage\Http\Controllers\Support\SupportController;
use NetworkRailBusinessSystems\SupportPage\Http\Controllers\Support\SupportDetailController;

class SupportPageProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/support-page.php',
            'support-page'
        );
    }

    public function boot(): void
    {
        $this->bootPublishes();
        $this->bootRoutes();
        $this->bootViews();
    }

    protected function bootPublishes(): void
    {
        $this->publishes([
            __DIR__.'/../../config/support-page.php' => config_path('support-page.php'),
            __DIR__.'/../../resources/views/components' => resource_path('views/components'),
            __DIR__.'/../../resources/views/support' => resource_path('views/support'),
        ], 'support-page');

        //        $this->publishes([
        //            __DIR__.'/../../database/factories/SupportDetailFactory.php' => database_path('factories/SupportDetailFactory.php'),
        //            __DIR__.'/../../database/migrations/2023_02_07_105304_create_support_details_table.php' => database_path('migrations/2023_02_07_105304_create_support_details_table.php'),
        //        ], 'support-page-data');
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
}
