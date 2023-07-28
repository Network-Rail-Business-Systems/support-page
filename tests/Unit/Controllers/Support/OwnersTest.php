<?php

namespace Unit\Controllers\Support;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use NetworkRailBusinessSystems\SupportPage\Http\Controllers\Support\SupportController;
use Spatie\Permission\Models\Role;
use config('support-page.test_case');

class OwnersTest extends TestCase
{
    protected Collection $users;

    protected SupportController $controller;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->users = config('support-page.user_model')->factory(
            ->count(3)
            ->withRole(config('support-page.update_permissions')::ADMIN)
            ->create()
            ->sortBy('first_name');

        $this->controller = new SupportController();
        $this->redirect = $this->controller->owners(Role::findByName((config('support-page.update_permissions')::ADMIN)->id);
    }

    public function testRedirectsToMailto(): void
    {
        $this->assertEquals(
            'mailto:'.$this->users->pluck('email')->join(';').'?subject='.config('support-page.support_detail_model')::getEnquirySubject(),
            $this->redirect->getTargetUrl(),
        );
    }
}
