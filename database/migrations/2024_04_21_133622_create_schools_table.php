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
    Schema::create('schools', function (Blueprint $table) {
      $table->id();
      $table->string("name", 255)->nullable(false);
      $table->string("schoolYear", 255)->nullable(false);
      $table->string("logo", 255)->nullable(false);
      $table->datetime("firstDay")->nullable(false);
      $table->datetime("lastDay")->nullable(false);
      $table->timestamps();
    });
  }
  
  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('schools');
  }
};
