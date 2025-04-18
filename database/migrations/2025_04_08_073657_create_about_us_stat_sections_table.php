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
    Schema::create('about_us_stat_sections', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->string('subtitle')->nullable();
      $table->text('description');

      $table->string('stat_1_label')->default('Years in Business');
      $table->integer('stat_1_value')->default(0);

      $table->string('stat_2_label')->default('Global Clients');
      $table->integer('stat_2_value')->default(0);

      $table->string('stat_3_label')->default('Digital Experts');
      $table->integer('stat_3_value')->default(0);

      $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us_stat_sections');
    }
};
