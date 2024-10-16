<?php

return [
    'enquiry_route' => 'https://systems.hiav.networkrail.co.uk/home/forms/enquiry/start',

    'excluded_roles' => [],

    'permission' => 'manage_support_page',

    'role_model' => Spatie\Permission\Models\Role::class,

    'user_model' => App\Models\User::class,
];
