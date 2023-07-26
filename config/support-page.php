<?php

return [
    'user_model' => env('USER_MODEL', 'app/Models/User.php'),
    'support_detail_model' => env('SUPPORT_DETAIL_MODEL', 'Networkrailbusinesssystems\SupportPage\Models\SupportDetail'),
    'update_permissions' => env('UPDATE_PERMISSIONS', 'app/Console/Commands/UpdatePermissions.php'),
];
