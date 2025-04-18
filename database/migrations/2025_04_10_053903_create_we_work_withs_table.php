<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
  public function up(): void
  {
    Schema::create('we_work_with', function (Blueprint $table) {
      $table->id();
      $table->string('tab_name')->unique();
      $table->string('title');
      $table->text('description');
      $table->json('features'); 
      $table->string('image');
      $table->string('icon')->nullable();
      $table->string('image_alt')->nullable();
      $table->string('icon_alt')->nullable();
      $table->timestamps();
    });
  }

  
  public function down(): void
  {
    Schema::dropIfExists('we_work_with');
  }
};
