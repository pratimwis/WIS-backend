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
    Schema::create('home_service_sections', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->text('description');
      $table->string('icon'); 
      $table->string('image'); 
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('web_services_cards');
  }
};
