<?php

namespace NetworkRailBusinessSystems\SupportPage\Unit\Requests\Support\TypeRequest;

use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\TypeRequest;
use PHPUnit\Framework\TestCase;

class AuthorizeTest extends TestCase
{
    public function testReturnsTrue(): void
    {
        $request = new TypeRequest();
        $this->assertTrue($request->authorize());
    }
}
