<?php

use App\Models\User;
use NetworkRailBusinessSystems\SupportPage\Http\Resources\SupportDetailCollection;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;

return [
    'user_model' => env('USER_MODEL', User::class),
    'support_detail_model' => env('SUPPORT_DETAIL_MODEL', SupportDetail::class),
    'support_detail_collection' => env('SUPPORT_DETAIL_COLLECTION', SupportDetailCollection::class),
    'excluded_roles' => [],
];
