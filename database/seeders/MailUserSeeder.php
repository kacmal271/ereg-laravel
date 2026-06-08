<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MailUserSeeder extends Seeder
{
  /**
  * Run the database seeds.
  */
  public static function run(): void
  {
    ///////////////////////////////////////////////////////////////////////////////
    // MAIL id=1

    DB::table('mail_user')->insert([
      'id' => 1,
      'mail_id' => 1,
      'user_id' => 1,
      'isSoftDeleted' => false,
      'created_at' => new \DateTimeImmutable('2030-01-01'), // MAIL DELIVERY DATE TO someone
                                                            // it should be shared by every receiver
      'updated_at' => new \DateTimeImmutable('2030-01-01')

    ]);

    DB::table('mail_user')->insert([
      'id' => 2,
      'mail_id' => 1,
      'user_id' => 2,
      'isSoftDeleted' => false,
      'created_at' => new \DateTimeImmutable('2030-01-01'),
      'updated_at' => new \DateTimeImmutable('2030-01-01')

    ]);

    DB::table('mail_user')->insert([
      'id' => 3,
      'mail_id' => 1,
      'user_id' => 3,
      'isSoftDeleted' => false,
      'created_at' => new \DateTimeImmutable('2030-01-01'),
      'updated_at' => new \DateTimeImmutable('2030-01-01')

    ]);


    DB::table('mail_user')->insert([
      'id' => 4,
      'mail_id' => 1,
      'user_id' => 4,
      'isSoftDeleted' => false,
      'created_at' => new \DateTimeImmutable('2030-01-01'),
      'updated_at' => new \DateTimeImmutable('2030-01-01')

    ]);

    ///////////////////////////////////////////////////////////////////////////////
    // MAIL id=2

    DB::table('mail_user')->insert([
      'id' => 5,
      'mail_id' => 2,
      'user_id' => 1,
      'isSoftDeleted' => false,
      'created_at' => new \DateTimeImmutable('2000-05-20'),
      'updated_at' => new \DateTimeImmutable('2000-05-20')

    ]);

    DB::table('mail_user')->insert([
      'id' => 6,
      'mail_id' => 2,
      'user_id' => 2,
      'isSoftDeleted' => false,
      'created_at' => new \DateTimeImmutable('2000-05-20'),
      'updated_at' => new \DateTimeImmutable('2000-05-20')

    ]);

    DB::table('mail_user')->insert([
      'id' => 7,
      'mail_id' => 2,
      'user_id' => 3,
      'isSoftDeleted' => false,
      'created_at' => new \DateTimeImmutable('2000-05-20'),
      'updated_at' => new \DateTimeImmutable('2000-05-20')

    ]);


    DB::table('mail_user')->insert([
      'id' => 8,
      'mail_id' => 2,
      'user_id' => 4,
      'isSoftDeleted' => false,
      'created_at' => new \DateTimeImmutable('2000-05-20'),
      'updated_at' => new \DateTimeImmutable('2000-05-20')

    ]);

    ///////////////////////////////////////////////////////////////////////////////
    // MAIL id=3

    DB::table('mail_user')->insert([
      'id' => 9,
      'mail_id' => 3,
      'user_id' => 1,
      'isSoftDeleted' => false,
      'created_at' => new \DateTimeImmutable('2000-06-17'),
      'updated_at' => new \DateTimeImmutable('2000-06-17')

    ]);

    DB::table('mail_user')->insert([
      'id' => 10,
      'mail_id' => 3,
      'user_id' => 2,             // MAIL id=3 is a self-sent
      'isSoftDeleted' => false,
      'created_at' => new \DateTimeImmutable('2000-06-17'),
      'updated_at' => new \DateTimeImmutable('2000-06-17')

    ]);

    DB::table('mail_user')->insert([
      'id' => 11,
      'mail_id' => 3,
      'user_id' => 3,
      'isSoftDeleted' => false,
      'created_at' => new \DateTimeImmutable('2000-06-17'),
      'updated_at' => new \DateTimeImmutable('2000-06-17')

    ]);


    DB::table('mail_user')->insert([
      'id' => 12,
      'mail_id' => 3,
      'user_id' => 4,
      'isSoftDeleted' => false,
      'created_at' => new \DateTimeImmutable('2000-06-17'),
      'updated_at' => new \DateTimeImmutable('2000-06-17')

    ]);

    ///////////////////////////////////////////////////////////////////////////////
    // MAIL id=4

    DB::table('mail_user')->insert([
      'id' => 13,
      'mail_id' => 4,
      'user_id' => 1,
      'isSoftDeleted' => false,
      'created_at' => new \DateTimeImmutable('2000-04-18'),
      'updated_at' => new \DateTimeImmutable('2000-04-18')

    ]);

    ///////////////////////////////////////////////////////////////////////////////
    // MAIL id=5

    DB::table('mail_user')->insert([
      'id' => 14,
      'mail_id' => 5,
      'user_id' => 1,
      'isSoftDeleted' => false,
      'created_at' => new \DateTimeImmutable('2000-06-17'),
      'updated_at' => new \DateTimeImmutable('2000-06-17')

    ]);

    ///////////////////////////////////////////////////////////////////////////////
    // MAIL id=6

    DB::table('mail_user')->insert([
      'id' => 15,
      'mail_id' => 6,
      'user_id' => 1,
      'isSoftDeleted' => false,
      'created_at' => new \DateTimeImmutable('2000-06-17'),
      'updated_at' => new \DateTimeImmutable('2000-06-17')

    ]);

    ///////////////////////////////////////////////////////////////////////////////
    // MAIL id=7

    DB::table('mail_user')->insert([
      'id' => 16,
      'mail_id' => 7,
      'user_id' => 1,
      'isSoftDeleted' => false,
      'created_at' => new \DateTimeImmutable(),
      'updated_at' => new \DateTimeImmutable()

    ]);

  }

}
