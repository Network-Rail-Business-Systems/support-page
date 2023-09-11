<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportDetailsTable extends Migration
{
    public function up(): void
    {
        Schema::create('support_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('type');
            $table->text('target');
            $table->string('label');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_details');
    }
}
