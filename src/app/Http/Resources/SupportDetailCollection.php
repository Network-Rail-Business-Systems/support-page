<?php

namespace Networkrailbusinesssystems\SupportPage\Http\Resources;

//use App\Traits\ResourceCollectionAsArray;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SupportDetailCollection extends ResourceCollection
{
    //try to remove this trait and test
    //use ResourceCollectionAsArray;

    public $collects = SupportDetailResource::class;
}
