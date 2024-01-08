<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Requests\Support\TypeRequest;

use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\TypeRequest;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class AuthorizeTest extends TestCase
{
    public function testReturnsTrue(): void
    {
        $request = new TypeRequest();
        $this->assertTrue($request->authorize());
    }
}
