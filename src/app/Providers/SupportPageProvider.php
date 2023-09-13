<?php

namespace NetworkRailBusinessSystems\SupportPage\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
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
            __DIR__.'/../../resources/views/support' => resource_path('views/vendor/support-page/support'),
        ], 'support-page');

        $this->publishes([
            __DIR__.'/../../database/migrations/2023_02_07_105304_create_support_details_table.php' => database_path('migrations/2023_02_07_105304_create_support_details_table.php'),
        ], 'support-page-data');
    }

    protected function bootRoutes(): void
    {
        Route::macro('supportPage', function () {
            Route::prefix('/support-details')
                ->name('support-details.')
                ->controller(SupportDetailController::class)
                ->group(function () {
                    Route::get('/manage', 'index')->name('index');
                    Route::get('/delete/{supportDetail}', 'delete')->name('delete');
                    Route::get('/', 'support')->name('show');
                    Route::get('/owner-team/{role}', 'owners')->name('owners');
                });

            Route::redirect('/enquiry-form', 'https://systems.networkrail.co.uk/enquiry')->name('enquiry-form');

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
