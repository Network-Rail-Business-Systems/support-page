<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Requests\Support\TargetRequest;

use NetworkRailBusinessSystems\SupportPage\Tests\Http\Requests\Support\TargetRequest;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class AuthorizeTest extends TestCase
{
    public function testReturnsTrue(): void
    {
        $request = new TargetRequest();
        $this->assertTrue($request->authorize());
    }
}
