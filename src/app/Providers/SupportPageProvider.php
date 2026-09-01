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
            __DIR__ . '/../../config/support-page.php',
            'support-page',
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
        $template = config('support-page.template', 'govuk');

        $this->publishes([
            __DIR__ . '/../../config/support-page.php' => config_path('support-page.php'),
            __DIR__ . '/../../database/migrations/2023_02_07_105304_create_support_details_table.php' => database_path('migrations/2023_02_07_105304_create_support_details_table.php'),
        ], 'support-page');

        $this->publishes([
            __DIR__ . "/../../resources/views/$template" => resource_path("views/vendor/support-page"),
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
                });
        });

        Route::macro('supportPageAdmin', function () {
            Route::prefix('/support')
                ->name('support-page.')
                ->controller(SupportPageController::class)
                ->group(function () {
                    Route::get('/manage', 'index')->name('index');
                    Route::get('/{supportDetail}/confirm', 'confirm')->name('delete');
                    Route::get('/{supportDetail}/deleted', 'delete')->name('deleted');
                });
        });
    }

    protected function bootViews(): void
    {
        $template = config('support-page.template', 'govuk');

        $packageViews = __DIR__ . "/../../resources/views/$template";

        $publishedViews = resource_path(
            "views/vendor/support-page",
        );

        $this->loadViewsFrom(
            [
                $publishedViews,
                $packageViews,
            ],
            'support-page',
        );


        if ($template === 'bulma') {
            $finder = app('view')->getFinder();

            $finder->prependNamespace(
                'form-builder',
                $packageViews,
            );

            if (is_dir($publishedViews) === true) {
                $finder->prependNamespace(
                    'form-builder',
                    $publishedViews,
                );
            }
        }
    }
}
