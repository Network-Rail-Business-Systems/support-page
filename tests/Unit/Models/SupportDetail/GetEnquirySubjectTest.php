<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Models\SupportDetail;

use NetworkRailBusinessSystems\SupportPage\Tests\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

class GetEnquirySubjectTest extends TestCase
{
    public function testGetEnquirySubject(): void
    {
        $this->assertEquals('Enquiry about '.config('app.name'), SupportDetail::getEnquirySubject());
    }
}
