<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use NetworkRailBusinessSystems\SupportPage\Tests\Models\User;
use Spatie\Permission\Models\Role;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'email' => $this->faker->email(),
        ];
    }

    public function withRole(string $role): self
    {
        return $this->afterCreating(function (User $user) use ($role) {
            $user->assignRole(Role::findOrCreate($role));
        });
    }
}
