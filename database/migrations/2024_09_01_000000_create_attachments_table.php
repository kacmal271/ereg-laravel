<?php

use App\Models\Mail;

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
    Schema::create('attachments', function (Blueprint $table)
    {
      $table->id();                                               // PK
      $table->string("attachmentFileName", 255)->nullable(false); // not null
      $table->string("mimeType", 255)->nullable(false);           // not null // image/jpeg
      $table->foreignIdFor(Mail::class)
        ->references('id')->on('mails')->onDelete('cascade');
      $table->timestamps();                                       // created_at, updated_at

    });
    
  }
  
  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('attachments');
  }
};
