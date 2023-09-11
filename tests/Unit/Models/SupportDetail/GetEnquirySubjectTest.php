<?php

namespace NetworkRailBusinessSystems\SupportPage\Unit\Models\SupportDetail;

use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use TestCase;

class GetEnquirySubjectTest extends TestCase
{
    public function testGetEnquirySubject(): void
    {
        $this->assertEquals('Enquiry about '.config('app.name'), SupportDetail::getEnquirySubject());
    }
}
