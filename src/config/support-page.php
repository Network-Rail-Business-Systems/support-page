<?php

return [
    'enquiry_route' => 'enquiry',

    'excluded_roles' => [],

    'permission' => 'manage_support_page',

    'support_page_title' => 'Support',

    'role_model' => Spatie\Permission\Models\Role::class,

    'user_model' => App\Models\User::class,

    /**
     * Optional parent layout used by the Bulma templates.
     *
     * name: Blade view to extend.
     * section: Layout section to render content into.
     */
    'layout' => [
        'name' => null,
        'section' => null,
    ],

    /** Which blade template set to use: govuk, bulma */
    'template' => 'govuk',
];
