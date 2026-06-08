<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * This Class - Goals
 * # initialize production server with hard-coded data
 */

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//-----------------------------------------------------------------------------
class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // id=1 Parent

    DB::table('roles')->insert([
      'id' => 1,
      'code' => config('role.parent.code'),
      'name' => config('role.parent.name')

    ]);

    // id=2 Student

    DB::table('roles')->insert([
      'id' => 2,
      'code' => config('role.student.code'),
      'name' => config('role.student.name')

    ]);

    // id=3 Admin

    DB::table('roles')->insert([
      'id' => 3,
      'code' => config('role.admin.code'),
      'name' => config('role.admin.name')

    ]);

    // id=4 Teacher

    DB::table('roles')->insert([
      'id' => 4,
      'code' => config('role.teacher.code'),
      'name' => config('role.teacher.name')

    ]);

  }

}
