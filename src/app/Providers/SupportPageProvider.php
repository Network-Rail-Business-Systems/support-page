<?php

namespace Networkrailbusinesssystems\SupportPage\Providers;

use Illuminate\Support\ServiceProvider;

class SupportPageProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->bootRoutes();
        $this->bootViews();

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
