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
    Schema::create('our_vision_missions', function (Blueprint $table) {
      $table->id();
      $table->text('vision_title');
      $table->text('vision_description');
      $table->text('mission_title');
      $table->text('mission_description');
      $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('our_vision_missions');
    }
};
