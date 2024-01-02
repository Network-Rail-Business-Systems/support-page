<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Requests\Support\LabelRequest;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\LabelQuestion;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\LabelRequest;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class RulesTest extends TestCase
{
    protected LabelRequest $request;

    protected array $rules;

    protected function setUp(): void
    {
        parent::setUp();
        $this->request = new LabelRequest();

        $this->rules = $this->request->rules();
    }

    public function testHasRequired(): void
    {
        $this->assertContains(
            'required',
            $this->rules[LabelQuestion::key()],
        );
    }

    public function testHasString(): void
    {
        $this->assertContains(
            'string',
            $this->rules[LabelQuestion::key()],
        );
    }
}
