<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttachmentSeeder extends Seeder
{
  /**
  * Run the database seeds.
  */
  public function run(): void
  {
    ///////////////////////////////////////////////////////////////////////////////
    // MAIL ID 1

    DB::table('attachments')->insert([
      'id' => 1,
      'attachmentFileName' => 'kombajn-zbozowy-osiowy.jpg',
      'mimeType' => 'image/jpeg',
      'mail_id' => 1,
      'created_at' => new \DateTimeImmutable('2000-01-01'),
      'updated_at' => new \DateTimeImmutable('2000-01-01')
    ]);

    DB::table('attachments')->insert([
      'id' => 2,
      'attachmentFileName' => 'kombajn-zbozowy-styczny-print.docx',
      'mimeType' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
      'mail_id' => 1,
      'created_at' => new \DateTimeImmutable('2000-01-01'),
      'updated_at' => new \DateTimeImmutable('2000-01-01')
    ]);

    DB::table('attachments')->insert([
      'id' => 3,
      'attachmentFileName' => 'Laravel-Presentation.pptx',
      'mimeType' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
      'mail_id' => 1,
      'created_at' => new \DateTimeImmutable('2000-01-01'),
      'updated_at' => new \DateTimeImmutable('2000-01-01')
    ]);

    ///////////////////////////////////////////////////////////////////////////////
    // MAIL ID 2

    DB::table('attachments')->insert([
      'id' => 4,
      'attachmentFileName' => 'microbit-syntax.py',
      'mimeType' => 'text/plain',
      'mail_id' => 2,
      'created_at' => new \DateTimeImmutable('2000-05-20'),
      'updated_at' => new \DateTimeImmutable('2000-05-20')
    ]);
    
  }

}
