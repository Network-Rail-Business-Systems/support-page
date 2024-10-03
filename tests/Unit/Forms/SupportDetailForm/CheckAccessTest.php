<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Forms\SupportDetailForm;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Config;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use NetworkRailBusinessSystems\SupportPage\Tests\Models\User;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class CheckAccessTest extends TestCase
{
    protected User $user;

    protected SupportDetailForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->form = new SupportDetailForm();
    }

    public function testCanAccessForm(): void
    {
        Config::set('support-page.permission', null);

        try {
            $this->form->checkAccess();
            $this->assertTrue(true);
        } catch (AuthorizationException $exception) {
            $this->fail('Unable to access the form');
        }
    }

    public function testIsAuthorized(): void
    {
        Config::set('support-page.permission', 'manage_support_page');

        $this->signInWithPermission('manage_support_page');

        $this->form->checkAccess();
        $this->assertTrue(true);
    }

    public function testIsUnauthorized(): void
    {
        Config::set('support-page.permission', 'manage_support_page');

        $this->expectExceptionMessage('This action is unauthorized');

        $this->form->checkAccess();
        $this->fail();
    }
}
