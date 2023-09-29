<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Controllers\SupportDetail;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use NetworkRailBusinessSystems\SupportPage\Console\Commands\UpdatePermissions;
use NetworkRailBusinessSystems\SupportPage\Http\Controllers\Support\SupportDetailController;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\Models\User;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;
use Spatie\Permission\Models\Role;

class OwnersTest extends TestCase
{
    protected Collection $users;

    protected SupportDetailController $controller;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->users = User::factory()
            ->count(3)
            ->withRole(UpdatePermissions::ADMIN) //can replace with admin string role// may need to create the role
            ->create()
            ->sortBy('first_name');

        $this->controller = new SupportDetailController();
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
