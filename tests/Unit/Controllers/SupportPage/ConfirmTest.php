<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Controllers\SupportPage;

use Illuminate\Contracts\View\View;
use NetworkRailBusinessSystems\SupportPage\Http\Controllers\SupportPageController;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class ConfirmTest extends TestCase
{
    protected SupportDetail $supportDetail;

    protected SupportPageController $controller;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->supportDetail = SupportDetail::factory()->create();

        $this->controller = new SupportPageController();
        $this->view = $this->controller->confirm($this->supportDetail);
    }

    public function testHasView(): void
    {
        $this->assertEquals(
            'support-page::details.confirm',
            $this->view->name(),
        );
    }

    public function testHasSupportDetail(): void
    {
        $this->assertEquals(
            $this->supportDetail->id,
            $this->view->getData()['supportDetail']->id,
        );
    }
}
