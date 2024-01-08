<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Controllers\SupportPage;

use Illuminate\Contracts\View\View;
use NetworkRailBusinessSystems\SupportPage\Http\Controllers\SupportPageController;
use NetworkRailBusinessSystems\SupportPage\Http\Resources\SupportDetailCollection;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class IndexTest extends TestCase
{
    protected SupportPageController $controller;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->controller = new SupportPageController();
        $this->view = $this->controller->index();
    }

    public function testHasSupportDetails(): void
    {
        $this->assertEquals(
            SupportDetailCollection::make(SupportDetail::query()->paginate()),
            $this->view->getData()['supportDetails'],
        );
    }
}
