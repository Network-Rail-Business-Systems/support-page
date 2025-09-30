<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests;

use AnthonyEdmonds\GovukLaravel\Providers\GovukServiceProvider;
use AnthonyEdmonds\LaravelFormBuilder\LaravelFormBuilderServiceProvider;
use AnthonyEdmonds\LaravelTestingTraits\AssertsActivities;
use AnthonyEdmonds\LaravelTestingTraits\AssertsFlashMessages;
use AnthonyEdmonds\LaravelTestingTraits\AssertsFormRequests;
use AnthonyEdmonds\LaravelTestingTraits\AssertsResults;
use AnthonyEdmonds\LaravelTestingTraits\SignsInUsers;
use Illuminate\Support\Facades\Config;
use Laracasts\Flash\FlashServiceProvider;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Providers\SupportPageProvider;
use NetworkRailBusinessSystems\SupportPage\Tests\Models\User;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use AssertsActivities;
    use AssertsFlashMessages;
    use AssertsFormRequests;
    use AssertsResults;
    use SignsInUsers;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpRoutes();
        $this->useDatabase();

        Config::set('support-page.permission', null);
        Config::set('support-page.user_model', User::class);
        Config::set('testing-traits.user_model', User::class);

        Permission::create(['name' => 'manage_support_page']);
    }

    protected function getPackageProviders($app): array
    {
        return [
            GovukServiceProvider::class,
            LaravelFormBuilderServiceProvider::class,
            FlashServiceProvider::class,
            PermissionServiceProvider::class,
            SupportPageProvider::class,
        ];
    }

    protected function useDatabase(): void
    {
        $this->app->useDatabasePath(__DIR__ . '/../src/database');
        $this->runLaravelMigrations();
    }

    protected function setUpRoutes(): void
    {
        Config::set('form-builder.forms', [
            SupportDetailForm::class,
        ]);

        $router = app('router');
        $router->get('/')->name('/');
        $router->laravelFormBuilder();
        $router->supportPage();
        $router->redirect('/enquiry', 'https://systems.networkrail.co.uk/enquiry')->name('enquiry');
    }

    protected function makeRole(string $name): Role
    {
        return Role::create([
            'name' => $name,
        ]);
    }
}
