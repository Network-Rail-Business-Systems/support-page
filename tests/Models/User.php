<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use NetworkRailBusinessSystems\SupportPage\Tests\Factories\UserFactory;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory;
    use HasRoles;
    use Notifiable;

    protected $fillable = ['*'];

    protected $guard_name = 'web';

    protected static function newFactory()
    {
        return new UserFactory();
    }
}
