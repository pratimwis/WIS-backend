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
    Schema::create('banner_sections', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->json('blinkingText');
      $table->string('description');
      $table->string('buttonText');
      $table->string('backgroundImage');
      $table->string('imageAlt')->nullable(); // Added imageAlt field
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('banner_sections');
  }
};
