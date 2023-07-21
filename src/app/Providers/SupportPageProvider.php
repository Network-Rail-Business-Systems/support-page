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
}
