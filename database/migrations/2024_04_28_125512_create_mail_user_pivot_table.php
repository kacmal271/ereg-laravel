<?php

// use case: assist in creating referential integrity
use App\Models\Mail;
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
    Schema::create('mail_user', function (Blueprint $table)
    {
      $table->id();                                               // PK
      $table->foreignIdFor(Mail::class)                           // mail_id
            ->references('id')->on('mails')
            ->onDelete('cascade');

      $table->foreignIdFor(User::class)                           // "receiverId"
            ->references('id')->on('users')                       // ! this.user_id and that.id values must match
            ->onDelete('cascade');                                // ! referencial integrity
                                                                  
      $table->boolean('isSoftDeleted')->nullable(false)->default(false);
      $table->timestamps(); // createdAt = sent on, to each receiver, on the same day 
                            // updatedAt

    });

  }
  
  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('mail_user');
  }
};
