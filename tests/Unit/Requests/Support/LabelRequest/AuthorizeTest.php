<?php

namespace NetworkRailBusinessSystems\SupportPage\Unit\Requests\Support\LabelRequest;

use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\LabelRequest;
use TestCase;

class AuthorizeTest extends TestCase
{
    public function testReturnsTrue(): void
    {
        $request = new LabelRequest();
        $this->assertTrue($request->authorize());
    }
}
