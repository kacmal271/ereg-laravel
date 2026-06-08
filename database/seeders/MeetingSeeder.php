<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeetingSeeder extends Seeder
{
  /**
  * Run the database seeds.
  */
  public function run(): void
  {
    ///////////////////////////////////////////////////////////////////////////////
    // TEACHER ID 1

    DB::table('meetings')->insert([
      'id'                    => 1,
      'user_id'               => 4,
      'group_id'              => 1,
      'startTime'             => new \DateTimeImmutable('2024-12-12 18:00:00'),
      'endTime'               => new \DateTimeImmutable('2024-12-12 18:00:00'),
      'meetingName'           => 'Organizacja Państwa',
      'meetingDescription'    => 'Strukturę osadniczą państwa Mieszka I stanowiły opola, które były znane już w epoce plemiennej.\n„O-pole” oznaczało społeczność sąsiedzko-lokalną zamieszkującą wokół pasa pól uprawnych i pastwisk stanowiących podstawę ich bytu.',
      'created_at'            => new \DateTimeImmutable('now'),
      'updated_at'            => new \DateTimeImmutable('now')
    ]);

    DB::table('meetings')->insert([
      'id'                    => 2,
      'user_id'               => 4,
      'group_id'              => 1,
      'startTime'             => new \DateTimeImmutable('2024-12-12 17:30:00'),
      'endTime'               => new \DateTimeImmutable('2024-12-12 19:00:00'),
      'meetingName'           => 'Jubileusz II Chrztu Polski',
      'meetingDescription'    => 'W tym roku Polska przyjęła układ SI',
      'created_at'            => new \DateTimeImmutable('now'),
      'updated_at'            => new \DateTimeImmutable('now')
    ]);

    DB::table('meetings')->insert([
      'id'                    => 3,
      'user_id'               => 4,
      'group_id'              => 1,
      'startTime'             => new \DateTimeImmutable('2024-10-31 16:45:00'),
      'endTime'               => new \DateTimeImmutable('2024-10-31 17:20:00'),
      'meetingName'           => 'Zjazd Gnieźnieński',
      'meetingDescription'    => 'W pielgrzymce do grobu świętego Wojciecha i w celu pozyskania Chrobrego do swych idei\nuniwersalistycznego cesarstwa przybył do Gniezna w roku 1000 cesarz Otton III.\nPodczas zjazdu gnieźnieńskiego utworzono niezależną polską organizację kościelną z metropolią w Gnieźnie i biskupstwami w Krakowie, Kołobrzegu i Wrocławiu.',
      'created_at'            => new \DateTimeImmutable('now'),
      'updated_at'            => new \DateTimeImmutable('now')
    ]);

    DB::table('meetings')->insert([
      'id'                    => 4,
      'user_id'               => 10,
      'group_id'              => 1,
      'startTime'             => new \DateTimeImmutable('2024-10-31 19:15:00'),
      'endTime'               => new \DateTimeImmutable('2024-10-31 20:00:00'),
      'meetingName'           => 'Zjazd Gnieźnieński',
      'meetingDescription'    => 'W pielgrzymce do grobu świętego Wojciecha i w celu pozyskania Chrobrego do swych idei\nuniwersalistycznego cesarstwa przybył do Gniezna w roku 1000 cesarz Otton III.\nPodczas zjazdu gnieźnieńskiego utworzono niezależną polską organizację kościelną z metropolią w Gnieźnie i biskupstwami w Krakowie, Kołobrzegu i Wrocławiu.',
      'created_at'            => new \DateTimeImmutable('now'),
      'updated_at'            => new \DateTimeImmutable('now')
    ]);

    DB::table('meetings')->insert([
      'id'                    => 5,
      'user_id'               => 10,
      'group_id'              => 2,
      'startTime'             => new \DateTimeImmutable('2024-11-01 20:15:00'),
      'endTime'               => new \DateTimeImmutable('2024-11-01 20:30:00'),
      'meetingName'           => 'Koronacja',
      'meetingDescription'    => 'Tuż po śmierci ojca Mieszko został koronowany na króla Polski 25 grudnia 1025 przez arcybiskupa gnieźnieńskiego Hipolita\nw katedrze gnieźnieńskiej.',
      'created_at'            => new \DateTimeImmutable('now'),
      'updated_at'            => new \DateTimeImmutable('now')
    ]);

    DB::table('meetings')->insert([
      'id'                    => 6,
      'user_id'               => 4,
      'group_id'              => 2,
      'startTime'             => new \DateTimeImmutable('2025-04-04 19:45:00'),
      'endTime'               => new \DateTimeImmutable('2024-04-04 19:56:00'),
      'meetingName'           => 'Wycieczka Szkolna',
      'meetingDescription'    => 'W roku 1047 ma odbyć się wycieczka szkolna do klasztoru benedyktyńskiego w Brauweiler.\nObecność na Zebraniu obowiązkowa.',
      'created_at'            => new \DateTimeImmutable('now'),
      'updated_at'            => new \DateTimeImmutable('now')
    ]);
    
  }
}
