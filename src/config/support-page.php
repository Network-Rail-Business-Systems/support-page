<?php

use Spatie\Permission\Models\Role;

return [
    'excluded_roles' => [],

    'permission' => 'manage_support_page',

    'role_model' => Role::class,

    'user_model' => App\Models\User::class,
];
