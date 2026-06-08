<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
  /**
  * Run the database seeds.
  */
  public function run(): void
  {
    DB::table('subjects')->insert([
      'id' => 1,
      'abbreviation' => 'wf',
      'subjectName' => 'Wychowanie Fizyczne',
      'created_at' => new \DateTimeImmutable('now'),    // current
      'updated_at' => new \DateTimeImmutable('now')     // current

    ]);

    DB::table('subjects')->insert([
      'id' => 2,
      'abbreviation' => 'mat.',
      'subjectName' => 'Matematyka',
      'created_at' => new \DateTimeImmutable('now'),    // current
      'updated_at' => new \DateTimeImmutable('now')     // current

    ]);

    DB::table('subjects')->insert([
      'id' => 3,
      'abbreviation' => 'j. pol.',
      'subjectName' => 'Język Polski',
      'created_at' => new \DateTimeImmutable('now'),    // current
      'updated_at' => new \DateTimeImmutable('now')     // current

    ]);

    DB::table('subjects')->insert([
      'id' => 4,
      'abbreviation' => 'tech.',
      'subjectName' => 'Technika',
      'created_at' => new \DateTimeImmutable('now'),    // current
      'updated_at' => new \DateTimeImmutable('now')     // current

    ]);

  }

}
