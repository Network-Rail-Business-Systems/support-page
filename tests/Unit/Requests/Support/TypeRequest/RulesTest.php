<?php

namespace NetworkRailBusinessSystems\SupportPage\Unit\Requests\Support\TypeRequest;

use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\TypeRequest;
use TestCase;

class RulesTest extends TestCase
{
    protected TypeRequest $request;

    protected array $rules;

    protected function setUp(): void
    {
        parent::setUp();
        $this->request = new TypeRequest();

        $this->rules = $this->request->rules();
    }

    public function testHasRequired(): void
    {
        $this->assertContains(
            'required',
            $this->rules[TypeQuestion::key()],
        );
    }

    public function testHasOptions(): void
    {
        $rule = $this->rules[TypeQuestion::key()][1]->__toString();

        foreach (TypeQuestion::OPTIONS as $option => $value) {
            $this->assertStringContainsString(
                $option,
                $rule,
            );
        }
    }
}
