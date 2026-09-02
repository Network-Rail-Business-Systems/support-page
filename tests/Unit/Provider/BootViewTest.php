<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Provider;

use Illuminate\Support\Facades\View;
use NetworkRailBusinessSystems\SupportPage\Providers\SupportPageProvider;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class BootViewTest extends TestCase
{
    protected SupportPageProvider $provider;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('support-page.template', 'bulma');

        $this->provider = new SupportPageProvider($this->app);
    }

    public function test(): void
    {
        $this->provider->boot();

        $this->assertTrue(
            View::exists('support-page::show'),
        );

        $this->assertTrue(
            View::exists('support-page::components.actions'),
        );

        $this->assertTrue(
            View::exists('form-builder::components.inputs.input'),
        );

        $this->assertTrue(
            View::exists('form-builder::question'),
        );

        $this->assertTrue(
            View::exists('form-builder::summary'),
        );
    }
}
