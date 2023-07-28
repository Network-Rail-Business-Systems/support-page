<?php


use AnthonyEdmonds\LaravelLdapEmulator\Providers\LdapEmulatorServiceProvider;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use LdapRecord\Laravel\Testing\DirectoryEmulator;
use Tests\Traits\AssertsActivities;
use Tests\Traits\AssertsFlashMessages;
use Tests\Traits\AssertsFormRequests;
use Tests\Traits\AssertsOrder;
use Tests\Traits\AssertsPolicies;
use Tests\Traits\AssertsResults;
use Tests\Traits\AssertsValidationRules;
use Tests\Traits\GetsRawCsvs;
use Tests\Traits\GetsStreamedResponses;
use Tests\Traits\SignsInUsers;

abstract class TestCase extends BaseTestCase
{
    use \Tests\CreatesApplication;
    use LazilyRefreshDatabase;
    use AssertsActivities;
    use AssertsResults;
    use AssertsFormRequests;
    use AssertsFlashMessages;
    use AssertsPolicies;
    use AssertsOrder;
    use SignsInUsers;
    use GetsRawCsvs;
    use GetsStreamedResponses;
    use AssertsValidationRules;

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
