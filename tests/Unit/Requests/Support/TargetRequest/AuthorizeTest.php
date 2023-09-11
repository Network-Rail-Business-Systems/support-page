<?php

namespace NetworkRailBusinessSystems\SupportPage\Unit\Requests\Support\TargetRequest;

use NetworkRailBusinessSystems\SupportPage\Http\Requests\Support\TargetRequest;
use PHPUnit\Framework\TestCase;

class AuthorizeTest extends TestCase
{
    public function testReturnsTrue(): void
    {
        $request = new TargetRequest();
        $this->assertTrue($request->authorize());
    }
}
