<?php

use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;

return [
    'user_model' => env('USER_MODEL', \App\Models\User::class),
    'support_detail_model' => env('SUPPORT_DETAIL_MODEL', SupportDetail::class),
    'update_permissions' => env('UPDATE_PERMISSIONS', \App\Console\Commands\UpdatePermissions::class),
];
