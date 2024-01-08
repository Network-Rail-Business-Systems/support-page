<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TABLE_NAMES = [
        'roles' => 'roles',
        'permissions' => 'permissions',
        'model_has_permissions' => 'model_has_permissions',
        'model_has_roles' => 'model_has_roles',
        'role_has_permissions' => 'role_has_permissions',
    ];

    public function up(): void
    {
        $tableNames = self::TABLE_NAMES;

        $columnNames = [
            'model_morph_key' => 'model_id',
        ];

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use (
            $tableNames,
            $columnNames,
        ) {
            $table->unsignedInteger('permission_id');

            $table->string('model_type');
            $table->unsignedInteger($columnNames['model_morph_key']);
            $table->index(
                [$columnNames['model_morph_key'], 'model_type'],
                'model_has_permissions_model_id_model_type_index',
            );

            $table
                ->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table
                ->foreign('model_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary(
                ['permission_id', $columnNames['model_morph_key'], 'model_type'],
                'model_has_permissions_permission_model_type_primary',
            );
        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use (
            $tableNames,
            $columnNames,
        ) {
            $table->unsignedInteger('role_id');

            $table->string('model_type');
            $table->unsignedInteger($columnNames['model_morph_key']);
            $table->index(
                [$columnNames['model_morph_key'], 'model_type'],
                'model_has_roles_model_id_model_type_index',
            );

            $table
                ->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreign('model_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary(
                ['role_id', $columnNames['model_morph_key'], 'model_type'],
                'model_has_roles_role_model_type_primary',
            );
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use (
            $tableNames,
        ) {
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('role_id');

            $table
                ->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary(
                ['permission_id', 'role_id'],
                'role_has_permissions_permission_id_role_id_primary',
            );
        });
    }

    public function down(): void
    {
        $tableNames = self::TABLE_NAMES;

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
};
