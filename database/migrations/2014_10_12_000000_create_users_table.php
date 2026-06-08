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
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('password', 255)->nullable(false);
      $table->unsignedBigInteger('group_id')->nullable(true);
      $table->string('fname', 255)->nullable(false);
      $table->string('lname', 255)->nullable(false);
      $table->string('email', 255)->nullable(true)->unique();
      $table->dateTime('previousLogIn')->nullable(true);
      $table->dateTime('lastLogIn')->nullable(true);
      $table->unsignedBigInteger('role_id')->nullable(true);
      $table->string('picturePath')->nullable(false);
      $table->timestamp('email_verified_at')->nullable();
      $table->rememberToken();
      $table->timestamps();
    });
  }
  
  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
