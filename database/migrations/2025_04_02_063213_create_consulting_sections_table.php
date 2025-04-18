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
    Schema::create('consulting_sections', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->text('description');
      $table->json('points'); // Store points as JSON (title & description)
      $table->json('dropdown_options'); // Store dropdown options as JSON
      $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consulting_sections');
    }
};
