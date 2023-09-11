<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Requests\Support\LabelRequest;

use NetworkRailBusinessSystems\SupportPage\Tests\Http\Requests\Support\LabelRequest;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class AuthorizeTest extends TestCase
{
    public function testReturnsTrue(): void
    {
        $request = new LabelRequest();
        $this->assertTrue($request->authorize());
    }
}
