<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Controllers\SupportPage;

use Illuminate\Contracts\View\View;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Http\Controllers\SupportPageController;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class ShowTest extends TestCase
{
    protected SupportPageController $controller;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->controller = new SupportPageController();
    }

    public function testHasList(): void
    {
        $this->makeRequest();

        $path = base_path();
        $index = strrpos($path, DIRECTORY_SEPARATOR);
        $build = substr($path, $index + 1);

        $this->assertEquals(
            [
                'Name' => config('app.name'),
                'Acronym' => config('app.acronym'),
                'Build' => $build,
                'Laravel' => app()->version(),
                'PHP' => phpversion(),
            ],
            $this->view->getData()['list'],
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
            SupportDetail::factory()
                ->withType($key)
                ->create();
        }
    }
}
