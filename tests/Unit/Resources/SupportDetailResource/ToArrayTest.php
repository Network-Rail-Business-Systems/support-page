<?php

namespace NetworkRailBusinessSystems\SupportPage\Unit\Resources\SupportDetailResource;

use Illuminate\Http\Request;
use NetworkRailBusinessSystems\SupportPage\Http\Resources\SupportDetailResource;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use PHPUnit\Framework\TestCase;

class ToArrayTest extends TestCase
{
    protected SupportDetail $subject;

    protected SupportDetailResource $resource;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = SupportDetail::factory()->create();

        $this->resource = new SupportDetailResource($this->subject);
    }

    public function testHasArrayKeys(): void
    {
        $keys = ['type', 'target', 'label', 'editLink', 'deleteLink'];

        foreach ($keys as $key) {
            $this->assertArrayHasKey($key, $this->resource->toArray(new Request()));
        }
    }
}
