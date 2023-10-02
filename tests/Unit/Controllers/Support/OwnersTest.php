<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Controllers\Support;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use NetworkRailBusinessSystems\SupportPage\Http\Controllers\Support\SupportController;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\Models\User;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;
use NetworkRailBusinessSystems\SupportPage\Tests\Unit\Controllers\SupportDetail\Role;

class OwnersTest extends TestCase
{
    protected Collection $users;

    protected SupportController $controller;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->users = User::factory()
            ->count(3)
            ->withRole('admin')
            ->create()
            ->sortBy('first_name');

        $this->controller = new SupportController();
        $this->redirect = $this->controller->owners(Role::findByName('admin')->id);
    }

    public function testRedirectsToMailto(): void
    {
        $this->assertEquals(
            'mailto:'.$this->users->pluck('email')->join(';').'?subject='.SupportDetail::getEnquirySubject(),
            $this->redirect->getTargetUrl(),
        );
    }
}
