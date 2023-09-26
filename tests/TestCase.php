<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use NetworkRailBusinessSystems\SupportPage\Providers\SupportPageProvider;
use NetworkRailBusinessSystems\SupportPage\Tests\Traits\AssertsActivities;
use NetworkRailBusinessSystems\SupportPage\Tests\Traits\AssertsFlashMessages;
use NetworkRailBusinessSystems\SupportPage\Tests\Traits\AssertsFormRequests;
use NetworkRailBusinessSystems\SupportPage\Tests\Traits\AssertsResults;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use AssertsActivities;
    use AssertsFlashMessages;
    use AssertsFormRequests;
    use AssertsResults;
    //use LazilyRefreshDatabase;

    protected function getPackageProviders($app): array
    {
        return [
            SupportPageProvider::class,
        ];
    }

    protected function useDatabase(): void
    {
        $this->app->useDatabasePath(__DIR__.'/../src/database');
        $this->runLaravelMigrations();
    }

    protected function setUp(): void
    {
        parent::setUp();
        config()->set('database.default', 'sqlite');

    }
}
