<?php

namespace NetworkRailBusinessSystems\SupportPage\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use NetworkRailBusinessSystems\SupportPage\Http\Controllers\SupportPageController;

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
            __DIR__.'/../../database/migrations/2023_00_00_000000_create_support_details_table.php' => database_path('migrations/2023_02_07_105304_create_support_details_table.php'),
        ], 'support-page');

        $this->publishes([
            __DIR__.'/../../resources/views/details' => resource_path('views/vendor/support-page/details'),
            __DIR__.'/../../resources/views/show.blade.php' => resource_path('views/vendor/support-page/show.blade.php'),
        ], 'support-page-views');
    }

    protected function bootRoutes(): void
    {
        Route::macro('supportPage', function () {
            Route::prefix('/support')
                ->name('support-page.')
                ->controller(SupportPageController::class)
                ->group(function () {
                    Route::get('/', 'show')->name('show');
                    Route::get('/{role}', 'owners')->name('owners');

                    Route::prefix('/admin')
                        ->name('admin.')
                        ->group(function () {
                            Route::get('/manage', 'index')->name('index');
                            Route::get('/{supportDetail}/confirm', 'confirm')->name('confirm');
                            Route::delete('/{supportDetail}/delete', 'delete')->name('delete');
                        });
                });
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
