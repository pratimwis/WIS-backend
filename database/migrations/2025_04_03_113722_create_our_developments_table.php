<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::create('our_developments', function (Blueprint $table) {
      $table->id();
      $table->string('section_id'); // ID like 'why-choose', 'development-company'
      $table->string('title');
      $table->string('bg_color'); // Background color
      $table->text('content'); // Description
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('our_developments');
  }
};
