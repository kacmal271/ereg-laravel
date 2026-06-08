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
    Schema::create('lessons', function (Blueprint $table) {
      $table->id();

      $table->foreignIdFor(App\Models\User::class)->nullable(false)       // Lesson needs Teacher
            ->references('id')->on('users')
            ->onDelete('cascade');
            
      $table->foreignIdFor(App\Models\Group::class)->nullable(false);    // Lesson needs Group of Students
      $table->foreignIdFor(App\Models\Subject::class)->nullable(false);  // Lesson is a Subject for 1 Group of Students led by 1 Teacher
      $table->timestamps();
    });
  }
  
  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('lessons');
  }
};
