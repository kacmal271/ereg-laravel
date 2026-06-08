<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Meetings Migration - TODO
 * # create trigger: on insert, startTime, endTime, set hh:mm:00
 */

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
    Schema::create('meetings', function (Blueprint $table)
    {
      $table->id();

      $table->foreignIdFor(App\Models\User::class)->nullable(false)    // user_id is "teacherId"
            ->references('id')->on('users')
            ->onDelete('cascade');

      $table->foreignIdFor(App\Models\Group::class)->nullable(false);   // group_id
      $table->datetime('startTime', 0)->nullable(false);                // Y-m-d hh:mm:00
      $table->datetime('endTime', 0)->nullable(false);                  // Y-m-d hh:mm:00
      $table->string('meetingName', 255)->nullable(false);              // Watch: Database reserved keywords 'when', 'name'
                                                                        // good practice
      $table->text('meetingDescription', 65535)->nullable(true);
      $table->timestamps();
    });
  }
  
  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('meetings');
  }
};
