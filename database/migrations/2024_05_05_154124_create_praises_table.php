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
    Schema::create('praises', function (Blueprint $table)
    {
      //
      // COLUMNS
      //

      $table->id();
      $table->unsignedBigInteger('studentId')->nullable(false);          
      $table->unsignedBigInteger('teacherId')->nullable(false);
      $table->string('title', 255)->nullable(false);
      $table->text('description', 65535)->nullable(false);
      $table->boolean('isNotice')->nullable(false);
      $table->timestamps();

      //
      // CONSTRAINTS
      //

      $table->foreign('studentId')
            ->references('id')->on('users')             // ! referencial integrity: this.studentId and that.id values must match
            ->onDelete('cascade');                      // ! referencial integrity: If that deleted Then delete this

      $table->foreign('teacherId')
            ->references('id')->on('users')          // ! referencial integrity: this.teacherId and that.id values must match
            ->onDelete('cascade');

    });
  }
  
  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('praises');
  }
};
