<?php

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Tests\CreatesApplication;
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
    use AssertsActivities;
    use AssertsFlashMessages;
    use AssertsFormRequests;
    use AssertsOrder;
    use AssertsPolicies;
    use AssertsResults;
    use AssertsValidationRules;
    use GetsRawCsvs;
    use GetsStreamedResponses;
    use LazilyRefreshDatabase;
    use SignsInUsers;
    use CreatesApplication;

    public function usePages(): void
    {
        Artisan::call('update:pages');
    }
}
