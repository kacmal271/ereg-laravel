<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
  /**
  * Run the database seeds.
  */
  public function run(): void
  {
    // ACTIVE

    DB::table('notifications')->insert([
      'id' => 1,
      'title' => 'Uroczyste Rozpoczęcie Roku Szkolnego',
      'notification' => 'Szanowni Państwo, w dniu 16-06-2077 o godzinie 10:00 w sali konferencyjnej rozpocznie się uroczystość rozpoczęcia roku szkolnego.\nObecność uczniów jest obowiązkowa. Powinni być obecni także rodzice klas młodszych.',
      'expires' => new \DateTimeImmutable('2025-06-01 12:29:00'),
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')

    ]);

    // ACTIVE

    DB::table('notifications')->insert([
      'id' => 2,
      'title' => 'Mundurki',
      'notification' => 'Od dzisiaj trzeba nosić mundurki',
      'expires' => new \DateTimeImmutable('2025-06-01 12:29:00'),
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')

    ]);

    // INACTIVE

    DB::table('notifications')->insert([
      'id' => 3,
      'title' => 'Wycieczka Szkolna - już nieaktywne',
      'notification' => 'Wycieczka szkolna do Krainy Internetu',
      'expires' => new \DateTimeImmutable('2023-06-01 12:29:00'),
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')

    ]);
    
  }

}
