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
            View::exists('form-builder::question'),
        );

        $this->assertTrue(
            View::exists('form-builder::components.actions'),
        );

        $this->assertTrue(
            View::exists('form-builder::components.inputs.input'),
        );
    }

    public function testPublishedBulmaViews(): void
    {
        $publishedViews = resource_path(
            'views/vendor/support-page/bulma',
        );

        if (is_dir($publishedViews) === false) {
            mkdir($publishedViews, 0755, true);
        }

        file_put_contents(
            $publishedViews . '/question.blade.php',
            '<div>Published question</div>',
        );

        $this->provider->boot();

        $hints = app('view')->getFinder()->getHints();

        $this->assertContains(
            $publishedViews,
            $hints['form-builder'],
        );

        unlink($publishedViews . '/question.blade.php');

        rmdir($publishedViews);
    }
}
