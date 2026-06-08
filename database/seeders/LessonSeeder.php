<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
  /**
  * Run the database seeds.
  */

  public function run(): void
  {
    ///////////////////////////////////////////////////////////////////////////////
    // CLASS 1A

    DB::table('lessons')->insert([
      'id' => 1,
      'user_id' => 4,                // teacherId
      'group_id' => 1,
      'subject_id' => 1,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
    ]);
    
    DB::table('lessons')->insert([
      'id' => 2,
      'user_id' => 4,                // teacherId
      'group_id' => 1,
      'subject_id' => 2,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
    ]);
    
    DB::table('lessons')->insert([
      'id' => 3,
      'user_id' => 10,                // teacherId
      'group_id' => 1,
      'subject_id' => 3,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
    ]);
    
    DB::table('lessons')->insert([
      'id' => 4,
      'user_id' => 10,                // teacherId
      'group_id' => 1,
      'subject_id' => 4,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
    ]);

    ///////////////////////////////////////////////////////////////////////////////
    // CLASS 2A

    DB::table('lessons')->insert([
      'id' => 5,
      'user_id' => 4,                // teacherId
      'group_id' => 2,
      'subject_id' => 1,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
    ]);
    
    DB::table('lessons')->insert([
      'id' => 6,
      'user_id' => 4,                // teacherId
      'group_id' => 2,
      'subject_id' => 2,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
    ]);
    
    DB::table('lessons')->insert([
      'id' => 7,
      'user_id' => 10,                // teacherId
      'group_id' => 2,
      'subject_id' => 3,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
    ]);

  }

}
