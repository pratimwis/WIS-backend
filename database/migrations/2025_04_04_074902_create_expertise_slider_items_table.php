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
    Schema::create('expertise_slider_items', function (Blueprint $table) {
      $table->id();
      $table->string('src');
      $table->string('label');
      $table->text('description');
      $table->string('background_color');
      $table->string('expertise_area');
      $table->string('years_of_experience');
      $table->json('key_projects');
      $table->json('team_members');
      $table->timestamps();
    });
  }
  

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('expertise_slider_items');
  }
};
