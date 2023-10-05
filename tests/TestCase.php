<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests;

use AnthonyEdmonds\GovukLaravel\Providers\GovukServiceProvider;
use Illuminate\Support\Facades\Config;
use Laracasts\Flash\FlashServiceProvider;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Providers\SupportPageProvider;
use NetworkRailBusinessSystems\SupportPage\Tests\Models\User;
use NetworkRailBusinessSystems\SupportPage\Tests\Traits\AssertsActivities;
use NetworkRailBusinessSystems\SupportPage\Tests\Traits\AssertsFlashMessages;
use NetworkRailBusinessSystems\SupportPage\Tests\Traits\AssertsFormRequests;
use NetworkRailBusinessSystems\SupportPage\Tests\Traits\AssertsResults;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use AssertsActivities;
    use AssertsFlashMessages;
    use AssertsFormRequests;
    use AssertsResults;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpRoutes();
        $this->useDatabase();

        Config::set('support-page.permission', null);
        Config::set('support-page.user_model', User::class);
    }

    protected function getPackageProviders($app): array
    {
        return [
            GovukServiceProvider::class,
            FlashServiceProvider::class,
            PermissionServiceProvider::class,
            SupportPageProvider::class,
        ];
    }

    protected function useDatabase(): void
    {
        $this->app->useDatabasePath(__DIR__.'/../src/database');
        $this->runLaravelMigrations();
    }

    protected function setUpRoutes(): void
    {
        Config::set('govuk.forms', [
            SupportDetailForm::class,
        ]);

        $router = app('router');
        $router->get('/')->name('/');
        $router->govukLaravelForms();
        $router->supportPage();
    }

    protected function makeRole(string $name): Role
    {
        return Role::create([
            'name' => $name,
        ]);
    }
}
