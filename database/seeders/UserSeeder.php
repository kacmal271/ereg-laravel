<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * UserSeeder Class - Goals
 * # populate database w/ test data
 * 
 * TODO
 * # store trigger - email handling
 */

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//-----------------------------------------------------------------------------
class UserSeeder extends Seeder
{
  //*****************************************************************************
  /**
  * Run the database seeds.
  */
  public function run(): void
  {

    ///////////////////////////////////////////////////////////////////////////////
    // PARENTS

    // Parent-1.1
    DB::table('users')->insert([
      'id' => 1,
      'password' => Hash::make('phplaravel'),
      'group_id' => null,                   // Parent
      'fname' => 'Mieszko',
      'lname' => 'Polan',

      // Mercury Mailer
      'email' => 'miepol@localhost',

      'lastLogIn' => new \DateTimeImmutable('now'),
      'role_id' => 1,                       // Parent
      'picturePath' => '/mieszko-i.jpg',    // up to developer
                                            // how image paths are stored
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')

    ]);

    // Parent-1.2
    DB::table('users')->insert([
      'id' => 5,
      'password' => Hash::make('phplaravel'),
      'group_id' => null,                   // Parent
      'fname' => 'Maria',
      'lname' => 'Dobroniega',

      // Mercury Mailer
      'email' => 'mardob@localhost',

      'lastLogIn' => new \DateTimeImmutable('now'),
      'role_id' => 1,                       // Parent
      'picturePath' => '/maria-dobroniega.jpg',
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')

    ]);

    // Parent-2
    DB::table('users')->insert([
      'id' => 6,
      'password' => Hash::make('phplaravel'),
      'group_id' => null,                   // Parent
      'fname' => 'Władysław',
      'lname' => 'Herman',

      // Mercury Mailer
      'email' => 'wlaher@localhost',

      'lastLogIn' => new \DateTimeImmutable('now'),
      'role_id' => 1,                       // Parent
      'picturePath' => '/wladyslaw-herman.jpg',
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')

    ]);

    ///////////////////////////////////////////////////////////////////////////////
    // STUDENT

    // Student-1.1
    DB::table('users')->insert([
      'id' => 2,
      'password' => Hash::make('phplaravel'),
      'group_id' => 1,                  // Student
      'fname' => 'Bolesław',
      'lname' => 'Chrobry',

      // Mercury Mailer
      'email' => 'bolchr@localhost',

      'previousLogIn' => new \DateTimeImmutable('2024-05-01 12:29:00'),
      'lastLogIn' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'role_id' => 2,                   // Student
      'picturePath' => '/boleslaw-i-chrobry.jpg',
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')

    ]);

    // Student-1.2
    DB::table('users')->insert([
      'id' => 7,
      'password' => Hash::make('phplaravel'),
      'group_id' => 2,                  // Student
      'fname' => 'Bolesław',
      'lname' => 'Krzywousty',

      // Mercury Mailer
      'email' => 'bolkrz@localhost',
      'previousLogIn' => new \DateTimeImmutable('2024-05-01 12:29:00'),
      // assert: future date
      'lastLogIn' => new \DateTimeImmutable('2025-03-01 12:29:00'),
      // Student
      'role_id' => 2,
      'picturePath' => '/boleslaw-krzywousty.jpg',
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')

    ]);

    // Student-2
    DB::table('users')->insert([
      'id' => 8,
      'password' => Hash::make('phplaravel'),
      'group_id' => 1,                  // Student
      'fname' => 'Władysław',
      'lname' => 'Wygnaniec',

      // Mercury Mailer
      'email' => 'wlawyg@localhost',

      'previousLogIn' => new \DateTimeImmutable('2024-05-01 12:29:00'),
      'lastLogIn' => new \DateTimeImmutable('now'),
      'role_id' => 2,                   // Student
      'picturePath' => '/wladyslaw-wygnaniec.jpg',
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')

    ]);

    ///////////////////////////////////////////////////////////////////////////////
    // ADMIN

    DB::table('users')->insert([
      'id' => 3,
      'password' => Hash::make('phplaravel'),
      'group_id' => null,                 // Admin
      'fname' => 'Mieszko',
      'lname' => 'Lambert',

      // Mercury Mailer
      'email' => 'mielam@localhost',

      'previousLogIn' => new \DateTimeImmutable('2024-05-01 12:29:00'),
      'lastLogIn' => new \DateTimeImmutable('now'),
      'role_id' => 3,                     // Admin
      'picturePath' => '/mieszko-ii-lambert.jpg',
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')

    ]);

    DB::table('users')->insert([
      'id' => 9,
      'password' => Hash::make('phplaravel'),
      'group_id' => null,                 // Admin
      'fname' => 'Bolesław',
      'lname' => 'Kędzierzawy',

      // Mercury Mailer
      'email' => 'bolked@localhost',

      'previousLogIn' => new \DateTimeImmutable('2024-05-01 12:29:00'),
      'lastLogIn' => new \DateTimeImmutable('now'),
      'role_id' => 3,                     // Admin
      'picturePath' => '/boleslaw-kedzierzawy.jpg',
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')

    ]);

    ///////////////////////////////////////////////////////////////////////////////
    // TEACHER

    DB::table('users')->insert([
      'id' => 4,
      'password' => Hash::make('phplaravel'),
      'group_id' => null,
      'fname' => 'Mieszko',
      'lname' => 'Stary',

      // Mercury Mailer
      'email' => 'miesta@localhost',

      'previousLogIn' => new \DateTimeImmutable('2024-05-01 12:29:00'),
      'lastLogIn' => new \DateTimeImmutable('now'),
      'role_id' => 4,
      'picturePath' => '/mieszko-stary.jpg',
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')

    ]);

    DB::table('users')->insert([
      'id' => 10,
      'password' => Hash::make('phplaravel'),
      'group_id' => null,
      'fname' => 'Kazimierz',
      'lname' => 'Sprawiedliwy',

      // Mercury Mailer
      'email' => 'kazspr@localhost',

      'previousLogIn' => new \DateTimeImmutable('2024-05-01 12:29:00'),
      'lastLogIn' => new \DateTimeImmutable('now'),
      'role_id' => 4,
      'picturePath' => '/kazimierz-sprawiedliwy.jpg',
      'created_at' => new \DateTimeImmutable('2024-06-01 12:29:00'),
      'updated_at' => new \DateTimeImmutable('2024-06-01 12:29:00')

    ]);

  }

}
