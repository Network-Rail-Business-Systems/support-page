<?php

namespace Unit\Controllers\Support;

use App\Console\Commands\UpdatePermissions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Networkrailbusinesssystems\SupportPage\Http\Controllers\Support\SupportController;
use Spatie\Permission\Models\Role;
use TestCase;

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
            ->withRole(UpdatePermissions::ADMIN)
            ->create()
            ->sortBy('first_name');

        $this->controller = new SupportController();
        $this->redirect = $this->controller->owners(Role::findByName(UpdatePermissions::ADMIN)->id);
    }

    public function testRedirectsToMailto(): void
    {
        $this->assertEquals(
            'mailto:'.$this->users->pluck('email')->join(';').'?subject='.config('support-page.support_detail_model')::getEnquirySubject(),
            $this->redirect->getTargetUrl(),
        );
    }
}
