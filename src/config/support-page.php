<?php

return [
    'user_model' => env('USER_MODEL', '\App\Models\User'),
    'support_detail_model' => env('SUPPORT_DETAIL_MODEL', '\NetworkRailBusinessSystems\SupportPage\Models\SupportDetail'),
    'update_permissions' => env('UPDATE_PERMISSIONS', '\App\Console\Commands\UpdatePermissions'),
];
