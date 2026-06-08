<?php

use App\Models\Schedule;
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
    Schema::create('nonattendances', function (Blueprint $table)
    {
      $table->id();
      $table->datetime("nonattendanceWhen")->nullable(false);   // nonattendance yyyy-mm-dd
                                                            //    2024-08-14
      $table->boolean("isExcused")->nullable(false);        // nonattendance excused
      $table->foreignIdFor(Schedule::class);                // nonattended schedule lesson

      $table->foreignIdFor(User::class)                // nonattending student_id
            ->references('id')->on('users')            // ! referencial integrity: this.studentId and that.id values must match
            ->onDelete('cascade');                     // ! referencial integrity: If that deleted Then delete this

      $table->timestamps();

    });

  }
  
  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('nonattendances');
  }
};
