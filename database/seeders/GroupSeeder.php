<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
  /**
  * Run the database seeds.
  */
  public function run(): void
  {
    // id=1

    DB::table('groups')->insert([
      'id' => 1,
      'name' => '1A',
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')

    ]);

    // id=2

    DB::table('groups')->insert([
      'id' => 2,
      'name' => '2A',
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')

    ]);

  }

}
