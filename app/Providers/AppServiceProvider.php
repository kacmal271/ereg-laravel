<?php

namespace App\Providers;

use \App\Models\Role;

// LIVEWIRE is not at localhost/livewire/[here]
use \Illuminate\Support\Facades\Route;

// week days array
use App\Helper\Extended\DateTime;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  
  /**
  * Register any application services.
  */
  public function register(): void
  {
    //

  }
  
  /**
  * Bootstrap any application services.
  */
  public function boot(): void
  {

    //
    // LIVEWIRE is not at localhost/livewire/[here]
    //

    \Livewire\Livewire::setUpdateRoute(function ($handle) {
      return Route::post(env('APP_RELATIVE_URL') . '/livewire/update', $handle);
    });

    \Livewire\Livewire::setScriptRoute(function ($handle) {
      return Route::get(url('/livewire/livewire.js'), $handle);
    });

    //
    // DATABASE PAGINATION
    //

    \Illuminate\Pagination\Paginator::defaultView('Snippet.pagination');
    \Illuminate\Pagination\Paginator::defaultSimpleView('Snippet.pagination');

    //
    // GLOBAL ARRAY
    //

    config([
      
      // Middleware
      'middleware.email.throttle' => 'throttle:44,1',

      // DateTime
      'format.datetime' => 'Y-m-d H:i:s', // standard format for DateTime ¯\_(ツ)_/¯
      'format.time-hour-minute' => 'H:i',

      // IMAGE
      'image.portraitPicture.width' => 200,
      'image.portraitPicture.height' => 300,

      // VALIDATOR
      'validator.integer.nonNegative' => ['numeric', 'integer', 'not_regex:/^-/'],
      'validator.numeric.nonNegative' => ['numeric', 'not_regex:/^-/'],
      'validator.email' => ['required', 'email', 'max:255'],
      'validator.password' => ['required', 'string', 'min:3', 'max:255'],

      // STORAGE: FILESYSTEM: '/var/myproject/...'
      'fs.filename.date' => (new \DateTime)->format('Ymd'),
      'fs.filename.seed.length' => 8,
      'fs.path.app' => $_SERVER['DOCUMENT_ROOT'] . env('APP_RELATIVE_URL'),
      'fs.path.storage.attachments' => $_SERVER['DOCUMENT_ROOT'] . env('APP_RELATIVE_URL') . '/storage/Attachment',
      'fs.path.storage.logo' => $_SERVER['DOCUMENT_ROOT'] . env('APP_RELATIVE_URL') . '/storage/Logo',
      'fs.path.storage.portraitPicture' => $_SERVER['DOCUMENT_ROOT'] . env('APP_RELATIVE_URL') . '/storage/PortraitPicture',

      // STORAGE: URL: 'https://...'
      'path.scripts.public' => url('/script'),
      'path.scripts.mail' => url('/script/Mail'),
      'path.scripts.school' => url('/script/School'),
      'path.scripts.user' => url('/script/User'),
      'path.storage.logo.urlPath' => url('/storage/Logo'),
      'path.storage.logo.saveAsPath' => '/storage/Logo',
      'path.storage.attachments.urlPath' => url('/storage/Attachment'),
			
        /**
         * relative path, used by \Illuminate\Http\UploadedFile
         * by default UploadedFile saves in /storage/app/[here]
         */
				 
      'path.storage.attachments.saveAsPath' => '/public/Attachment',
			
      'path.storage.portraitPicture' => url('/storage/PortraitPicture'), // (!) SMORT BOI
      'path.raster' => url('/raster'),
      'SVG-PATH' => url('/svg'),

      // USER ROLES
      'role.admin.name'      => 'admin',
      'role.parent.name'     => 'parent',
      'role.student.name'    => 'student',
      'role.teacher.name'    => 'teacher',
      'role.null.code'    => 0b0000,
      'role.admin.code'   => 0b0001,
      'role.parent.code'  => 0b0010,
      'role.student.code' => 0b0100,
      'role.teacher.code' => 0b1000,

      // VIEW:MAIL CONTENT
      'mail.paginator.onEachSide' => 2,
      'mail.paginator.itemsPerPage' => 2,

      // SCHEDULE ORGANIZATION
      'STUDY_DAYS_PER_WEEK' => 5,
      'WEEK_DAY_NAMES' => DateTime::weekDays()

    ]);

  }
  
}
