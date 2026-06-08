<?php

use App\Models\Subject;
use App\Models\Assessment;
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
    Schema::create('grades', function (Blueprint $table)
    {
      $table->id();
      $table->foreignIdFor(Subject::class);                   // subject_id
      $table->foreignIdFor(Assessment::class);                // assessment_id

      $table->foreignIdFor(User::class)                       // user_id
            ->references('id')->on('users')                   // ! this.user_id and that.id values must match
            ->onDelete('cascade');                            // ! referencial integrity
            
      $table->float('grade')->nullable(false);                // float grade
      $table->timestamps();
    });

  }
  
  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('grades');
    
  }

};
