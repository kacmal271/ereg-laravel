<?php

namespace Database\Seeders;

// creating record
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NonattendanceSeeder extends Seeder
{
  /**
  * Run the database seeds.
  */
  public function run(): void
  {
    // BOLESŁAW CHROBRY

    DB::table('nonattendances')->insert([
      'id'                      => 1,
      'nonattendanceWhen'       => new \DateTimeImmutable("2024-08-05"),
      'isExcused'               => false,
      'schedule_id'             => 1,
      'user_id'                 => 2,
      'created_at'              => new \DateTimeImmutable("now"),
      'updated_at'              => new \DateTimeImmutable("now")

    ]);
    
    // BOLESŁAW KRZYWOUSTY

    DB::table('nonattendances')->insert([
      'id'                      => 2,
      'nonattendanceWhen'      => new \DateTimeImmutable("2024-08-13"),
      'isExcused'               => true,
      'schedule_id'             => 14,
      'user_id'                 => 7,
      'created_at'              => new \DateTimeImmutable("now"),
      'updated_at'              => new \DateTimeImmutable("now")

    ]);

  }

}
