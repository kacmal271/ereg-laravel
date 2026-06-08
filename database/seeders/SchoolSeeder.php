<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
  /**
  * Run the database seeds.
  */
  public function run(): void
  {
    DB::table('schools')->insert([
      'id'                        => 1, // other seeder may reference
      'name'                      => 'Zamek na Wawelu',
      'schoolYear'                => '2024/25',
      'logo'                      => '/logo-school.svg',
      'firstDay'                  => new \DateTimeImmutable('2023-09-01 00:00:00'),
      'lastDay'                   => new \DateTimeImmutable('2024-06-21 00:00:00'),
      'created_at'                => new \DateTimeImmutable('2024-08-01 00:00:00'),
      'updated_at'                => new \DateTimeImmutable('2024-08-01 00:00:00')

    ]);
  }
}
