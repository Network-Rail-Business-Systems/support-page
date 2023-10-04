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
            __DIR__.'/../../config/details-page.php',
            'details-page'
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
            __DIR__.'/../../config/details-page.php' => config_path('details-page.php'),
            __DIR__.'/../../database/migrations/2023_02_07_105304_create_support_details_table.php' => database_path('migrations/2023_02_07_105304_create_support_details_table.php'),
        ], 'details-page');

        $this->publishes([
            __DIR__.'/../../resources/views/details' => resource_path('views/vendor/details-page/details'),
        ], 'details-page-views');
    }

    protected function bootRoutes(): void
    {
        Route::macro('supportPage', function () {
            Route::prefix('/details')
                ->name('details-page.')
                ->controller(SupportPageController::class)
                ->group(function () {
                    Route::redirect('/enquiry', config('support-page.enquiry_url'))->name('enquiry');

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
            'details-page'
        );
    }
}
