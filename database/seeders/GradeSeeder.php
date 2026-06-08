<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//-----------------------------------------------------------------------------
class GradeSeeder extends Seeder
{
  //*****************************************************************************
  /**
  * Run the database seeds.
  */
  public function run(): void
  {
    ///////////////////////////////////////////////////////////////////////////////
    // STUDENT id=2

    DB::table('grades')->insert([
      'subject_id' => 1,
      'assessment_id' => 1,
      'user_id' => 2,
      'grade' => 5,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
  
    ]);

    DB::table('grades')->insert([
      'subject_id' => 1,
      'assessment_id' => 1,
      'user_id' => 2,
      'grade' => 5,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
  
    ]);
    
    DB::table('grades')->insert([
      'subject_id' => 2,
      'assessment_id' => 2,
      'user_id' => 2,
      'grade' => 4,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
  
    ]);
    
    DB::table('grades')->insert([
      'subject_id' => 2,
      'assessment_id' => 2,
      'user_id' => 2,
      'grade' => 3,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
  
    ]);
    
    DB::table('grades')->insert([
      'subject_id' => 3,
      'assessment_id' => 3,
      'user_id' => 2,
      'grade' => 2,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
  
    ]);
    
    DB::table('grades')->insert([
      'subject_id' => 3,
      'assessment_id' => 4,
      'user_id' => 2,
      'grade' => 3,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
  
    ]);
    
    DB::table('grades')->insert([
      'subject_id' => 4,
      'assessment_id' =>5,
      'user_id' => 2,
      'grade' => 6,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
  
    ]);
    
    DB::table('grades')->insert([
      'subject_id' => 4,
      'assessment_id' => 4,
      'user_id' => 2,
      'grade' => 4,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
  
    ]);
    
    DB::table('grades')->insert([
      'subject_id' => 1,
      'assessment_id' => 1,
      'user_id' => 2,
      'grade' => 3,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
  
    ]);

  }

}
