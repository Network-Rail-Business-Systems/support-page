<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Traits;

use Illuminate\Auth\Access\Response;

trait AssertsPolicies
{
    protected function assertPolicyAllows(Response $response, string $expectedMessage)
    {
        $this->assertTrue($response->allowed());
        $this->assertEquals($expectedMessage, $response->message());
    }

    protected function assertPolicyDenies(Response $response, string $expectedMessage)
    {
        $this->assertFalse($response->allowed());
        $this->assertEquals($expectedMessage, $response->message());
    }
}
