<?php

namespace Tests\Unit\Controllers\Support;

use App\Forms\SupportDetail\Questions\TypeQuestion;
use App\Http\Controllers\Support\SupportController;
use App\Models\SupportDetail;
use Illuminate\Contracts\View\View;
use Tests\TestCase;

class SupportTest extends TestCase
{
    protected SupportController $controller;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->controller = new SupportController();
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

        $this->view = $this->controller->support();
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
