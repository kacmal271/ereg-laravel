<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MailSeeder extends Seeder
{
  /**
  * Run the database seeds.
  */
  public function run(): void
  {
    ///////////////////////////////////////////////////////////////////////////////
    // USER ID 1

    DB::table('mails')->insert([
      'id' => 1,
      'title' => 'Uroczysta Koronacja Mieszka I',
      'body' => 'Dzień dobry,\nTak naprawdę nidgy nie byłem koronowany.',
      'user_id' => 1,
      'created_at' => new \DateTimeImmutable('2000-01-01'),
      'updated_at' => new \DateTimeImmutable('2000-01-01')
    ]);

    DB::table('mails')->insert([
      'id' => 2,
      'title' => 'Drugi Chrzest Polski',
      'body' => 'Dzień dobry,\nDzisiaj mamy Międzynarodowy Dzień Metrologi 20-05.\nMieszko',
      'user_id' => 1,
      'created_at' => new \DateTimeImmutable('2000-05-20'),
      'updated_at' => new \DateTimeImmutable('2000-05-20')
    ]);

    ///////////////////////////////////////////////////////////////////////////////
    // USER ID 2

    DB::table('mails')->insert([
      'id' => 3,
      'title' => 'Moja Biografia',
      'body' => 'Dzień dobry,\nBył synem Mieszka I, księcia Polski i Dobrawy, czeskiej księżniczki. Ani miejsce, ani dokładna data urodzenia Bolesława nie są znane.\nBolesław',
      'user_id' => 2,
      'created_at' => new \DateTimeImmutable('2000-06-17'),
      'updated_at' => new \DateTimeImmutable('2000-06-17')
    ]);

    DB::table('mails')->insert([
      'id' => 4,
      'title' => 'Moja Koronacja',
      'body' => 'Dzień dobry,\nNajważniejszym aktem dokonanym podczas zjazdu gnieźnieńskiego była jednak symboliczna koronacja Bolesława Chrobrego na króla, dokonana poprzez nałożenie na jego skronie diademu cesarskiego.\nBolesław',
      'user_id' => 2,
      'created_at' => new \DateTimeImmutable('2000-04-18'),
      'updated_at' => new \DateTimeImmutable('2000-04-18')
    ]);

    DB::table('mails')->insert([
      'id' => 5,
      'title' => 'Post Mortem',
      'body' => 'Dzień dobry,\nNiech następcą będzie Mieszko II Lambert.\nBolesław',
      'user_id' => 2,
      'created_at' => new \DateTimeImmutable('2000-06-17'),
      'updated_at' => new \DateTimeImmutable('2000-06-17')
    ]);

    DB::table('mails')->insert([
      'id' => 6,
      'title' => 'Jan Matejko',
      'body' => 'Szanowny Panie Jan Alojzy Matejko,\n(ur. 24 czerwca 1838 w Krakowie, zm. 1 listopada 1893 tamże) polski malarz, twórca obrazów historycznych i batalistycznych, historiozof. Jeden z najwybitniejszych polskich malarzy w historii.\nBolesław',
      'user_id' => 2,
      'created_at' => new \DateTimeImmutable('2000-06-17'),
      'updated_at' => new \DateTimeImmutable('2000-06-17')
    ]);

    ///////////////////////////////////////////////////////////////////////////////
    // USER ID 3

    DB::table('mails')->insert([
      'id' => 7,
      'title' => 'Zagadka',
      'body' => 'Co ma cztery rogi i cztery nogi.\nGal Anonim',
      'user_id' => 3,
      'created_at' => new \DateTimeImmutable(),
      'updated_at' => new \DateTimeImmutable()
    ]);

  }

}
