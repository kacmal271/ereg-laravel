<?php

namespace Database\Seeders;

use \Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PraiseSeeder extends Seeder
{
  /**
  * Run the database seeds.
  */
  public function run(): void
  {
    ///////////////////////////////////////////////////////////////////////////////
    // STUDENT ID 2

    DB::table('praises')->insert([
      'id' => 1,
      'studentId' => 2,
      'teacherId' => 4,
      // GENERATED WITH ChatGPT: chatgpt.com
      'title' => 'Wzorowe zachowanie na lekcji',
      'description' => 'Student wykazał się pełnym zaangażowaniem i aktywnym udziałem w lekcji,\nco przyczyniło się do efektywnej pracy całej grupy.',
      'isNotice' => 0,
      'created_at' => new \DateTimeImmutable('2000-01-01'),
      'updated_at' => new \DateTimeImmutable('2000-01-01')
    ]);

    DB::table('praises')->insert([
      'id' => 2,
      'studentId' => 2,
      'teacherId' => 4,
      // GENERATED WITH ChatGPT: chatgpt.com
      'title' => 'Pomoc koleżeńska',
      'description' => 'Uczeń wykazał się dużą empatią, pomagając koledze, który miał trudności z zadaniem domowym.\nTakie wsparcie jest bardzo wartościowe.',
      'isNotice' => 0,
      'created_at' => new \DateTimeImmutable('2000-01-01'),
      'updated_at' => new \DateTimeImmutable('2000-01-01')
    ]);

    DB::table('praises')->insert([
      'id' => 3,
      'studentId' => 2,
      'teacherId' => 4,
      // GENERATED WITH ChatGPT: chatgpt.com
      'title' => 'Opuszczenie lekcji bez usprawiedliwienia',
      'description' => 'Uczeń opuścił lekcję bez wcześniejszego usprawiedliwienia, co jest niezgodne z regulaminem szkoły.\nProsimy o wyjaśnienie sytuacji.',
      'isNotice' => 1,
      'created_at' => new \DateTimeImmutable('2000-01-01'),
      'updated_at' => new \DateTimeImmutable('2000-01-01')
    ]);

    DB::table('praises')->insert([
      'id' => 4,
      'studentId' => 2,
      'teacherId' => 4,
      // GENERATED WITH ChatGPT: chatgpt.com
      'title' => 'Zaangażowanie w projekt grupowy',
      'description' => 'Uczeń włożył dużo pracy i entuzjazmu w realizację projektu grupowego, wykazując się zdolnościami organizacyjnymi i kreatywnością.',
      'isNotice' => 0,
      'created_at' => new \DateTimeImmutable('2000-01-01'),
      'updated_at' => new \DateTimeImmutable('2000-01-01')
    ]);

    DB::table('praises')->insert([
      'id' => 5,
      'studentId' => 2,
      'teacherId' => 10,
      // GENERATED WITH ChatGPT: chatgpt.com
      'title' => 'Spóźnienie na zajęcia',
      'description' => 'Uczeń spóźnił się na zajęcia o 15 minut bez usprawiedliwienia. Prosimy o poprawę punktualności.',
      'isNotice' => 1,
      'created_at' => new \DateTimeImmutable('2000-01-01'),
      'updated_at' => new \DateTimeImmutable('2000-01-01')
    ]);

    DB::table('praises')->insert([
      'id' => 6,
      'studentId' => 2,
      'teacherId' => 10,
      // GENERATED WITH ChatGPT: chatgpt.com
      'title' => 'Aktywność podczas dyskusji',
      'description' => 'Student aktywnie uczestniczył w dyskusji na temat lektury, wnosząc ciekawe spostrzeżenia i zadając inspirujące pytania.',
      'isNotice' => 0,
      'created_at' => new \DateTimeImmutable('2000-01-01'),
      'updated_at' => new \DateTimeImmutable('2000-01-01')
    ]);

    DB::table('praises')->insert([
      'id' => 7,
      'studentId' => 2,
      'teacherId' => 10,
      // GENERATED WITH ChatGPT: chatgpt.com
      'title' => 'Niestosowne zachowanie na przerwie',
      'description' => 'Uczeń zachowywał się niestosownie podczas przerwy, co zakłócało spokój innych uczniów. Prosimy o zachowanie zgodne z regulaminem.',
      'isNotice' => 1,
      'created_at' => new \DateTimeImmutable('2000-01-01'),
      'updated_at' => new \DateTimeImmutable('2000-01-01')
    ]);
  }
}
