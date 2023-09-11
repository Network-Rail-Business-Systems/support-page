<?php

namespace NetworkRailBusinessSystems\SupportPage\Unit\Controllers\Support;

use App\Console\Commands\UpdatePermissions;
use App\Http\Controllers\Support\SupportController;
use App\Models\SupportDetail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

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
            ->withRole(UpdatePermissions::ADMIN)
            ->create()
            ->sortBy('first_name');

        $this->controller = new SupportController();
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
