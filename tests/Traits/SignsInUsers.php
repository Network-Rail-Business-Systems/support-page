<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait SignsInUsers
{
    public function signIn(User $user = null): User
    {
        if ($user === null) {
            $user = User::factory()->create();
        }

        Auth::login($user);

        return $user;
    }

    public function signInAs(User $user): User
    {
        return $this->signIn($user);
    }

    public function signInWithRole(string $role, User $user = null): User
    {
        return $this->signIn($user)->assignRole($role);
    }

    public function signInWithPermission(string $permission, User $user = null): User
    {
        return $this->signIn($user)->givePermissionTo($permission);
    }
}
