<?php

namespace Networkrailbusinesssystems\SupportPage\Providers;

use Illuminate\Support\ServiceProvider;

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
        //ADD ROUTES

    }

    protected function bootViews(): void
    {
        $this->loadViewsFrom(
            __DIR__.'/../../resources/views',
            'support-page'
        );
    }
}
