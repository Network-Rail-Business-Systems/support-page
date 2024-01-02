<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Controllers\SupportDetail;

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

    public function testHasTitle(): void
    {
        $this->assertEquals(
            'Manage Support Details',
            $this->view->getData()['title']
        );
    }

    public function testHasContent(): void
    {
        $this->assertEquals(
            'support.index',
            $this->view->getData()['content']
        );
    }

    public function testHasList(): void
    {
        $this->assertEquals(
            [
                'Admin' => route('dashboard.admin'),
                'Manage Support Details' => route('support-details.index'),
            ],
            $this->view->getData()['breadcrumbs']
        );
    }

    public function testSetsSupportDetailView(): void
    {
        $this->assertEquals(
            SupportDetailCollection::make(SupportDetail::query()->paginate()),
            $this->view->getData()['supportDetails'],
        );
    }
}
