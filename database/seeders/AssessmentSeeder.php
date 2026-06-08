<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//-----------------------------------------------------------------------------
class AssessmentSeeder extends Seeder
{
  //*****************************************************************************
  /**
  * Run the database seeds.
  */
  public function run(): void
  {
    // id=1

    DB::table('assessments')->insert([
      'name' => 'Aktywność',
      'value' => 1,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
  
    ]);

    // id=2

    DB::table('assessments')->insert([
      'name' => 'Odpowiedź',
      'value' => 2,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
  
    ]);

    // id=3

    DB::table('assessments')->insert([
      'name' => 'Kartkówka',
      'value' => 3,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
  
    ]);

    // id=4

    DB::table('assessments')->insert([
      'name' => 'Sprawdzian',
      'value' => 4,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
  
    ]);

    // id=5

    DB::table('assessments')->insert([
      'name' => 'Praca Domowa',
      'value' => 2,
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')
  
    ]);

  }

}
