<?php

namespace Database\Seeders;

// DB (database) facade
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
  /**
  * Run the database seeds.
  */
  public function run(): void
  {
    ///////////////////////////////////////////////////////////////////////////////
    // CLASS 1A

    // *** MONDAY ***

    DB::table('schedules')->insert([
      'id'            => '1',
      'lesson_id'     => '1',
      'startTime'     => '08:50:00',
      'endTime'       => '09:35:00',
      'dayName'       => 'monday',
      'created_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
      'updated_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
  
    ]);

    DB::table('schedules')->insert([
      'id'            => '2',
      'lesson_id'     => '1',
      'startTime'     => '09:40:00',
      'endTime'       => '10:25:00',
      'dayName'       => 'monday',
      'created_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
      'updated_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
  
    ]);

    DB::table('schedules')->insert([
      'id'            => '3',
      'lesson_id'     => '2',
      'startTime'     => '10:30:00',
      'endTime'       => '11:15:00',
      'dayName'       => 'monday',
      'created_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
      'updated_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
  
    ]);

    DB::table('schedules')->insert([
      'id'            => '4',
      'lesson_id'     => '3',
      'startTime'     => '11:30:00',
      'endTime'       => '12:15:00',
      'dayName'       => 'monday',
      'created_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
      'updated_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
  
    ]);

    DB::table('schedules')->insert([
      'id'            => '5',
      'lesson_id'     => '3',
      'startTime'     => '12:20:00',
      'endTime'       => '13:05:00',
      'dayName'       => 'monday',
      'created_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
      'updated_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
  
    ]);

    // *** TUESDAY ***

    DB::table('schedules')->insert([
      'id'            => '6',
      'lesson_id'     => '1',
      'startTime'     => '08:00:00',
      'endTime'       => '08:45:00',
      'dayName'       => 'tuesday',
      'created_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
      'updated_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
  
    ]);

    DB::table('schedules')->insert([
      'id'            => '7',
      'lesson_id'     => '4',
      'startTime'     => '09:00:00',
      'endTime'       => '09:45:00',
      'dayName'       => 'tuesday',
      'created_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
      'updated_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
  
    ]);

    DB::table('schedules')->insert([
      'id'            => '8',
      'lesson_id'     => '4',
      'startTime'     => '10:00:00',
      'endTime'       => '10:45:00',
      'dayName'       => 'tuesday',
      'created_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
      'updated_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
  
    ]);

    DB::table('schedules')->insert([
      'id'            => '9',
      'lesson_id'     => '3',
      'startTime'     => '10:50:00',
      'endTime'       => '11:35:00',
      'dayName'       => 'tuesday',
      'created_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
      'updated_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
  
    ]);

    // *** FRIDAY ***

    DB::table('schedules')->insert([
      'id'            => '10',
      'lesson_id'     => '1',
      'startTime'     => '08:00:00',
      'endTime'       => '08:45:00',
      'dayName'       => 'friday',
      'created_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
      'updated_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
  
    ]);

    DB::table('schedules')->insert([
      'id'            => '11',
      'lesson_id'     => '4',
      'startTime'     => '09:00:00',
      'endTime'       => '09:45:00',
      'dayName'       => 'friday',
      'created_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
      'updated_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
  
    ]);

    DB::table('schedules')->insert([
      'id'            => '12',
      'lesson_id'     => '4',
      'startTime'     => '10:00:00',
      'endTime'       => '10:45:00',
      'dayName'       => 'friday',
      'created_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
      'updated_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
  
    ]);

    DB::table('schedules')->insert([
      'id'            => '13',
      'lesson_id'     => '3',
      'startTime'     => '10:50:00',
      'endTime'       => '11:35:00',
      'dayName'       => 'friday',
      'created_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
      'updated_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
  
    ]);

    ///////////////////////////////////////////////////////////////////////////////
    // CLASS 2A

    // *** TUESDAY ***

    DB::table('schedules')->insert([
      'id'            => '14',
      'lesson_id'     => '5',
      'startTime'     => '09:00:00',
      'endTime'       => '09:45:00',
      'dayName'       => 'tuesday',
      'created_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
      'updated_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
  
    ]);

    DB::table('schedules')->insert([
      'id'            => '15',
      'lesson_id'     => '6',
      'startTime'     => '10:00:00',
      'endTime'       => '10:45:00',
      'dayName'       => 'tuesday',
      'created_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
      'updated_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
  
    ]);

    DB::table('schedules')->insert([
      'id'            => '16',
      'lesson_id'     => '6',
      'startTime'     => '10:50:00',
      'endTime'       => '11:35:00',
      'dayName'       => 'tuesday',
      'created_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
      'updated_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
  
    ]);

    DB::table('schedules')->insert([
      'id'            => '17',
      'lesson_id'     => '7',
      'startTime'     => '11:40:00',
      'endTime'       => '12:25:00',
      'dayName'       => 'tuesday',
      'created_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
      'updated_at'    => new \DateTimeImmutable('2023-09-01 00:00:00'),
  
    ]);

  }

}
