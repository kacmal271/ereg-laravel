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
    // parent_student = table name
    Schema::create('parent_student', function (Blueprint $table)
    {	
      // COLUMNS

      $table->id();
      $table->unsignedBigInteger('studentId')->nullable(false);         
      $table->unsignedBigInteger('parentId')->nullable(false);
    
      // CONSTRAINTS
    
      $table->foreign('studentId')
            ->references('id')->on('users')             // ! referencial integrity: this.studentId and that.id values must match
            ->onDelete('cascade');                      // ! referencial integrity: If that deleted Then delete this
    
      $table->foreign('parentId')
            ->references('id')->on('users')             // ! referencial integrity: this.parentId and that.id values must match
            ->onDelete('cascade');                      // ! referencial integrity: If that deleted Then delete this

    });
    
  }
  
  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('parent_student');

  }
  
};
