<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Lessons Migration - TODO
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
    Schema::create('schedules', function (Blueprint $table)
    {
      $table->id();
      $table->foreignIdFor(\App\Models\Lesson::class)->nullable(false)
            ->references('id')->on('lessons')
            ->onDelete('cascade');
      $table->time('startTime', 0)->nullable(false);
      $table->time('endTime', 0)->nullable(false);
      $table->enum('dayName', config('WEEK_DAY_NAMES'))->nullable(false);   // save file AppService Provider.php
                                                                            // before using config() globals
      $table->timestamps();

    });
    
  }
  
  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('schedules');
  }
};
