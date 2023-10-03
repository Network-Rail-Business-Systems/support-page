<?php

namespace NetworkRailBusinessSystems\SupportPage\Traits;

use Illuminate\Database\Eloquent\Model;

trait SupportPageConfig
{
    protected function roleModel(): Model
    {
        $class = config('support-page.role_model');

        return new $class();
    }

    protected function userModel(): Model
    {
        $class = config('support-page.user_model');

        return new $class();
    }
}
