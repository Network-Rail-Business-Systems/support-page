<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Requests\Support\TargetRequest;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\TargetRequest;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class RulesTest extends TestCase
{
    protected TargetRequest $request;

    protected array $rules;

    protected function setUp(): void
    {
        parent::setUp();
        $this->request = new TargetRequest();

        $this->request->subject = SupportDetail::factory()->make();
    }

    public function testReturnsEmailAndRole(): void
    {
        $this->request->subject->type = TypeQuestion::SYSTEM_QUESTIONS;
        $this->rules = $this->request->rules();
        $this->assertArrayHasKey('email', $this->rules);
        $this->assertArrayHasKey('role', $this->rules);
    }

    public function testReturnsUrl(): void
    {
        $this->request->subject->type = TypeQuestion::GUIDES_AND_RESOURCES;
        $this->rules = $this->request->rules();
        $this->assertArrayHasKey('url', $this->rules);
    }
}
