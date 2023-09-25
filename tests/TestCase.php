<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use NetworkRailBusinessSystems\SupportPage\Providers\SupportPageProvider;
use NetworkRailBusinessSystems\SupportPage\Tests\Traits\AssertsActivities;
use NetworkRailBusinessSystems\SupportPage\Tests\Traits\AssertsFlashMessages;
use NetworkRailBusinessSystems\SupportPage\Tests\Traits\AssertsFormRequests;
use NetworkRailBusinessSystems\SupportPage\Tests\Traits\AssertsResults;


abstract class TestCase extends BaseTestCase
{
    use AssertsActivities;
    use AssertsFlashMessages;
    use AssertsFormRequests;
    use AssertsResults;
    use LazilyRefreshDatabase;
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

    }

    protected function getPackageProviders($app): array
    {
        return [
            SupportPageProvider::class,
        ];
    }

    protected function useDatabase(): void
    {
        $this->app->useDatabasePath(__DIR__.'/Database');
        $this->runLaravelMigrations();
    }


    public function tearDown(): void
    {
        DirectoryEmulator::tearDown();
        parent::tearDown();
    }

    public function useLdapEmulator(): void
    {
        LdapEmulatorServiceProvider::start();
    }

    public function usePages(): void
    {
        Artisan::call('update:pages');
    }
}
