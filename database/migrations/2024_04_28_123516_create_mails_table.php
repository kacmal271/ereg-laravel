<?php

use App\Models\User;

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
    Schema::create('mails', function (Blueprint $table)
    {
      $table->id();
      $table->string('title', 255)->nullable(false);
      $table->text('body', 65535)->nullable(true);
      $table->foreignIdFor(User::class)
        ->references('id')->on('users')
        ->onDelete('cascade');
      $table->timestamps(); // createdAt = napisanie, updatedAt

    });

  }
  
  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('mails');

  }
};
