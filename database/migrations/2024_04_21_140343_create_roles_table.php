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
    Schema::create('roles', function (Blueprint $table) {
      $table->id();
      $table->enum('name', array(   // AppServiceProvider.php
        config('role.parent.name'),    // global string definitions
        config('role.student.name'),
        config('role.admin.name'),
        config('role.teacher.name')
      ))->nullable(false)->unique(true);
      $table->unsignedInteger('code')     // AppServiceProvider.php
        ->nullable(false)->unique(true);  // global int definitions
    });
  }
  
  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('roles');
  }
};
