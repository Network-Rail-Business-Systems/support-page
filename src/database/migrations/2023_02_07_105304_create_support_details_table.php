<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('label');
            $table->string('type');
            $table->text('target');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_details');
    }
};
