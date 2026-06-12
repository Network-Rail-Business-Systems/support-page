<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Models\SupportDetail\Utilities;

use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class RouteNameTest extends TestCase
{
    public function testFindsRoute(): void
    {
        $this->assertEquals(
            'support-page.index',
            SupportDetail::routeName('index'),
        );
    }

    public function testThrowsException(): void
    {
        $this->expectException(RouteNotFoundException::class);
        $this->expectExceptionMessage('The Support Page "piggie" route has not been registered');

        SupportDetail::routeName('piggie');
    }
}
