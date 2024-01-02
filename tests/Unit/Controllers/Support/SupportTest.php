<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Controllers\Support;

use Illuminate\Contracts\View\View;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Http\Controllers\SupportPageController;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class SupportTest extends TestCase
{
    protected SupportPageController $controller;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->controller = new SupportPageController();
    }

    public function testHasTitle(): void
    {
        $this->makeRequest();

        $this->assertEquals(
            'Support',
            $this->view->getData()['title']
        );
    }

    public function testHasContent(): void
    {
        $this->makeRequest();

        $this->assertEquals(
            'support.page',
            $this->view->getData()['content']
        );
    }

    public function testHasList(): void
    {
        $this->makeRequest();

        $this->assertEquals(
            [
                'Name' => config('app.name'),
                'Acronym' => config('app.acronym'),
                'Build' => config('app.build'),
                'Laravel' => app()->version(),
                'PHP' => phpversion(),
            ],
            $this->view->getData()['list']
        );
    }

    public function testHasGroups(): void
    {
        $this->makeRequest(true);

        foreach (TypeQuestion::OPTIONS as $key => $value) {
            $this->assertTrue(
                $this->view->getData()['groups']->has($key),
            );
        }
    }

    public function testCreatesTechnicalQuestions(): void
    {
        $this->makeRequest();

        $this->assertTrue(
            $this->view->getData()['groups']->has(TypeQuestion::TECHNICAL_ISSUES),
        );

    }

    protected function makeRequest(bool $hasGroups = false): void
    {
        if ($hasGroups === true) {
            $this->createSupportDetails();
        }

        $this->view = $this->controller->show();
    }

    protected function createSupportDetails(): void
    {
        foreach (TypeQuestion::OPTIONS as $key => $value) {
            config('support-page.user_model')->factory()
                ->withType($key)
                ->create();
        }
    }
}
