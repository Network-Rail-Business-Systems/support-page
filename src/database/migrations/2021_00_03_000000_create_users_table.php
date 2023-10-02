<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $nameSql =
                DB::getDefaultConnection() === 'sqlite'
                    ? 'first_name || " " || last_name'
                    : 'CONCAT(first_name, " ", last_name)';

            $table->increments('id');
            $table->timestamps();
            $table->string('email')->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
