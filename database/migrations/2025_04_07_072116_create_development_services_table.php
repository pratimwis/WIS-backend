<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('development_services', function (Blueprint $table) {
      $table->id();
      $table->text('heading');
      $table->text('sub_heading');
      $table->json('points'); // for the 4 points list
      $table->longText('description');
      $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('development_services');
    }
};
