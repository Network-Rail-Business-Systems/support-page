<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UpdatePermissions extends Command
{
    const ADMIN = 'Admin';

    const ROLES = [self::ADMIN];

    const PERMISSIONS = [
        'access_admin' => [self::ADMIN],
        'grant_admin' => [self::ADMIN],
        'impersonate_users' => [self::ADMIN],
        'manage_users' => [self::ADMIN],
        'manage_support_page' => [self::ADMIN],
    ];

    protected $signature = 'update:permissions';

    protected $description = 'Updates permissions based on the matrix';

    public function handle(): void
    {
        $this->info('Loading existing roles...');
        $existingRoles = Role::query()->pluck('name', 'id');

        $this->info('Removing old roles...');
        Role::query()
            ->whereIn('name', $existingRoles->diff(self::ROLES))
            ->delete();

        $this->info('Removing permissions...');
        Permission::getQuery()->delete();

        $this->info('Adding new roles...');
        $newRoles = array_diff(self::ROLES, $existingRoles->toArray());

        $toInsert = [];
        foreach ($newRoles as $role) {
            $toInsert[] = [
                'name' => $role,
                'guard_name' => 'web',
            ];
        }

        Role::query()->insert($toInsert);

        $this->info('Reloading roles...');
        $existingRoles = Role::query()->pluck('id', 'name');

        $this->info('Adding permissions...');

        $toInsert = [];
        foreach (self::PERMISSIONS as $permission => $roles) {
            $toInsert[] = [
                'name' => $permission,
                'guard_name' => 'web',
            ];
        }

        Permission::query()->insert($toInsert);

        $this->info('Loading permissions...');
        $existingPermissions = Permission::query()->pluck('id', 'name');

        $this->info('Assigning permissions to roles...');
        $toInsert = [];

        foreach (self::PERMISSIONS as $permission => $roles) {
            foreach ($roles as $role) {
                $toInsert[] = [
                    'permission_id' => $existingPermissions[$permission],
                    'role_id' => $existingRoles[$role],
                ];
            }
        }

        DB::table('role_has_permissions')->insert($toInsert);

        $this->info('Resetting permission cache...');
        $this->call('permission:cache-reset');

        $this->info('Permission update complete!');
    }
}
