<?php

namespace App\Http\Resources;

use App\Traits\ResourceCollectionAsArray;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SupportDetailCollection extends ResourceCollection
{
    use ResourceCollectionAsArray;

    public $collects = SupportDetailResource::class;
}
