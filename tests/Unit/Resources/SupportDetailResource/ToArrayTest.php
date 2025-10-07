<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Unit\Resources\SupportDetailResource;

use NetworkRailBusinessSystems\SupportPage\Http\Resources\SupportDetailResource;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;
use NetworkRailBusinessSystems\SupportPage\Tests\TestCase;

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
        $this->assertEquals(
            [
                'type' => $this->subject->type,
                'target' => $this->subject->target,
                'label' => $this->subject->label,
                'editLink' => $this->subject->form()->editRoute(),
                'deleteLink' => route('support-page.admin.delete', $this->subject->id),
            ],
            $this->resource->toArray(request()),
        );
    }
}
