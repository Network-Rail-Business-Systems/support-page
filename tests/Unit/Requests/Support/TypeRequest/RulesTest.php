<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Requests\Support\TypeRequest;

use NetworkRailBusinessSystems\SupportPage\Tests\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Tests\Http\Requests\Support\TypeRequest;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

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
