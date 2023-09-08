<?php

use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;

return [
    'user_model' => env('USER_MODEL', \App\Models\User::class),
    'support_detail_model' => env('SUPPORT_DETAIL_MODEL', SupportDetail::class),
    'support_detail_collection' => env('SUPPORT_DETAIL_COLLECTION', \NetworkRailBusinessSystems\SupportPage\Http\Resources\SupportDetailCollection::class),
];
