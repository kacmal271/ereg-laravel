<?php

namespace Database\Seeders;

// This Class unlistenenes events drived from database interaction

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
  * Seed the application's database.
  */
  public function run(): void
  {
    $this->call([
      UserSeeder::class,            // order matters: Think: referential integrity
      NonattendanceSeeder::class,
      SchoolSeeder::class,
      NotificationSeeder::class,
      LessonSeeder::class,
      SubjectSeeder::class,
      RoleSeeder::class,
      GroupSeeder::class,

      ScheduleSeeder::class,        // order matters: after Lesson, User, Group
      
      AssessmentSeeder::class,
      GradeSeeder::class,
      MailSeeder::class,
      AttachmentSeeder::class,
      PraiseSeeder::class,
      MeetingSeeder::class

    ]);

    // Pivot Table Seeding
    ParentStudentSeeder::class::run();
    MailUserSeeder::class::run();

  }

}
