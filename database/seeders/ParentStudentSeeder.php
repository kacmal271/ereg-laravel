<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParentStudentSeeder extends Seeder
{
  /**
  * Run the database seeds.
  */
  public static function run(): void
  {
    // PARENT id=1

    DB::table('parent_student')->insert([
      'id' => 1,
      'parentId' => 1,
      'studentId' => 2

    ]);

    DB::table('parent_student')->insert([
      'id' => 2,
      'parentId' => 1,
      'studentId' => 7

    ]);

    DB::table('parent_student')->insert([
      'id' => 3,
      'parentId' => 1,
      'studentId' => 8

    ]);
    
  }

}
