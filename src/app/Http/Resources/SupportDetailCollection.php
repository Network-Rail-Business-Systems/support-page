<?php

namespace NetworkRailBusinessSystems\SupportPage\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use NetworkRailBusinessSystems\SupportPage\Traits\ResourceCollectionAsArray;

class SupportDetailCollection extends ResourceCollection
{
    use ResourceCollectionAsArray;

    public $collects = SupportDetailResource::class;
}
