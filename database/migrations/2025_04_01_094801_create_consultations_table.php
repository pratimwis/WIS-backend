<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
  public function up()
  {
    Schema::create('consultations', function (Blueprint $table) {
      $table->id();
      $table->string('fullName');
      $table->string('email');
      $table->string('phone');
      $table->string('helpTopic');
      $table->text('message')->nullable();
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('consultations');
  }
}
