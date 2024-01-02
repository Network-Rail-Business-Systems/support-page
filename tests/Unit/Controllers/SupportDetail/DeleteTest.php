<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Controllers\SupportDetail;

use Illuminate\Http\RedirectResponse;
use NetworkRailBusinessSystems\SupportPage\Http\Controllers\SupportPageController;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class DeleteTest extends TestCase
{
    protected SupportDetail $supportDetail;

    protected SupportPageController $controller;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->supportDetail = SupportDetail::factory()->create();

        $this->controller = new SupportPageController();
        $this->redirect = $this->controller->delete($this->supportDetail);
    }

    public function testDeletesRecord(): void
    {
        $this->assertDatabaseMissing(
            'support_details',
            $this->supportDetail->getAttributes(),
        );
    }

    public function testFlashesSuccessMessage(): void
    {
        $this->assertFlashed(
            "Record {$this->supportDetail->id} deleted.",
            'success',
        );
    }

    public function testRedirects(): void
    {
        $this->assertEquals(
            route('support-details.index'),
            $this->redirect->getTargetUrl(),
        );
    }
}
