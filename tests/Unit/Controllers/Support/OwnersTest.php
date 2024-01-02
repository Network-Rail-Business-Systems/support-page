<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Controllers\Support;

use App\Console\Commands\UpdatePermissions;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use NetworkRailBusinessSystems\SupportPage\Http\Controllers\SupportPageController;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;
use Spatie\Permission\Models\Role;

class OwnersTest extends TestCase
{
    protected Collection $users;

    protected SupportPageController $controller;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->users = User::factory()
            ->count(3)
            ->withRole(UpdatePermissions::ADMIN)
            ->create()
            ->sortBy('first_name');

        $this->controller = new SupportPageController();
        $this->redirect = $this->controller->owners(Role::findByName(UpdatePermissions::ADMIN)->id);
    }

    public function testRedirectsToMailto(): void
    {
        $this->assertEquals(
            'mailto:'.$this->users->pluck('email')->join(';').'?subject='.SupportDetail::getEnquirySubject(),
            $this->redirect->getTargetUrl(),
        );
    }
}
