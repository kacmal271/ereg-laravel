<?php

use \Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Helper\Enumeration\SchoolFeature;
use App\Helper\Enumeration\TimePeriod;
use App\Helper\Enumeration\Mailbox;
use App\Helper\Enumeration\Students;
use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

///////////////////////////////////////////////////////////////////////////////
// ROUTE MODEL BINDING

Route::bind('students', function ($value) {
  return Students::from($value);
});

Route::bind('mailbox', function ($value) {
  return Mailbox::from($value);
});

Route::bind('schoolFeature', function ($value) {
  return SchoolFeature::from($value);
});

// (A) Name Matters
// 'timePeriod' -> {timePeriod}

Route::bind('timePeriod', function ($value) {
  // casting datatype into other datatype
  // CANNOT INSTANTIATE ENUM
  return TimePeriod::from($value);
});

///////////////////////////////////////////////////////////////////////////////
// FUNCTIONS

//
// vvv Email Verification vvv
//

#
# /email/verify
#
# Routing Verification: View for sending
#

Route::get('/email/verify', function ()
{
  return redirect()->route('user.show', [
    'id' => auth()->user()->id
  ]);

})->middleware('auth')
  ->name('verification.notice');

#
# /email/verify/{id}/{hash}
#
# Routing Verification: Verification logic
# updating email_verified_at with CURRENT_TIMESTAMP
#

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request)
{
  $request->fulfill();
  return redirect()->route('home');

})->middleware(['auth', 'signed'])
  ->name('verification.verify');

#
# /email/verification-notification
#
# Routing Verification: RESENDING mail
#

Route::post('/email/verification-notification', function (Request $request)
{
  $request->user()->sendEmailVerificationNotification();

  return back()->with('emailVerificationMessage', __('New Verification E-Mail sent'));

})->middleware(['auth', config('middleware.email.throttle')])
  ->name('verification.send');

//
// ^^^ Email Verification ^^^
//

Route::get('/initialize', function() {
	// Reminder: $_SERVER['DOCUMENT_ROOT'] : 'C:\XAMPP\htdocs'
	$folder = $_SERVER['DOCUMENT_ROOT'] . '/../Ereg/storage/app/public';
	$symlink = $_SERVER['DOCUMENT_ROOT'] . '/ereg/storage';
	// CREATE: symlink
	symlink($folder, $symlink);
	echo 'Symlink: active';
})->middleware('auth');

///////////////////////////////////////////////////////////////////////////////
// RESTFUL RESOURCE CONTROLS
// Person: Guest, User

#
# /
#

Route::get('/',
[Controllers\Auth\LoginController::class, 'index'])
->name('auth.index');

///////////////////////////////////////////////////////////////////////////////
// RESTFUL RESOURCE CONTROLS and other
// Person: Guest

#
# /login
#

Route::post('/login',
[Controllers\Auth\LoginController::class, 'authenticate'])
->middleware('guest')->name('auth.show');

#
# /password-reset
#

Route::post('/password-reset',
[Controllers\Auth\ResetPasswordController::class, 'resetPassword'])
->middleware('guest')->name('auth.password.reset');

#
# /password-reset/{ token }
#

Route::get('/password-reset/{token}',
[Controllers\Auth\ResetPasswordController::class, 'index'])

// password.reset name is required by
// Illuminate\Support\Facades\Password
->middleware('guest')->name('password.reset');

#
# /password-resetting
#

Route::get('/password-resetting',
[Controllers\Auth\ForgotPasswordController::class, 'index'])
->middleware('guest')->name('auth.password.index');

#
# /password-resetting
#

Route::post('/password-resetting',
[Controllers\Auth\ForgotPasswordController::class, 'sendResetEmail'])
->middleware('guest')->name('auth.password.sendResetEmail');

///////////////////////////////////////////////////////////////////////////////
// RESTFUL RESOURCE CONTROLS and other
// Person: User

#
# (CREATE) ASSESSMENT
#
# /assessment/create
#

Route::get('/assessment/create',
[Controllers\AssessmentController::class, 'create'])
->name('assessment.create');

#
# (STORE) ASSESSMENT
#
# /assessment/store
#

Route::put('/assessment/store',
[Controllers\AssessmentController::class, 'store'])
->name('assessment.store');

#
# EDIT MY DATA
#
# /user/{ int id }/edit
#

Route::get('/user/{id}/edit',
[Controllers\UserController::class, 'edit'])
->name('user.edit');

#
# (CREATE) GRADE
#
# /grade/create
#

Route::get('/grade/create/feature/{schoolFeature}/group/{group}/subject/{subject}',
[Controllers\GradeController::class, 'create'])
->name('grades.create');

#
# (MY) GRADE
#
# /user/{ int id }/grades/{ bool isStatistics }
# 0 = display grades
# 1 = display barchart
#

Route::get('/user/{id}/grades/{isStatistics}',
[Controllers\GradeController::class, 'index'])
->name('grades.index');

#
# (CREATE) GROUP
#
# /group/create
#

Route::get('/group/create',
[Controllers\GroupController::class, 'create'])
->name('group.create');

#
# (STORE) GROUP
#
# /group/store
#

Route::put('/group/store',
[Controllers\GroupController::class, 'store'])
->name('group.store');

#
# HOME
#
# /home
#

Route::get('/home',
[Controllers\HomeController::class, 'index'])
->name('home');

#
# /logout
#

Route::get('/logout',
[Controllers\Auth\LoginController::class, 'logout'])
->middleware('auth')->name('auth.logout');

#
# (CREATE) MAIL
#
# (A) (!) BEFORE (INDEX) MAIL
#
# /mail/create
#

Route::get('/mail/create',
[Controllers\MailController::class, 'create'])
->name('mail.create');

#
# (DESTROY) MAIL
#
# /mail/{ int mail }/destroy
#

Route::delete('/mail/{mail}/destroy',
[Controllers\MailController::class, 'destroy'])
->name('mail.destroy');

#
# (DOWNLOAD) MAIL
#

Route::get('/mail/{attachment}/download',
[Controllers\MailController::class, 'download'])
->name('mail.download');

#
# (STORE) MAIL
#
# (A) (!) BEFORE (INDEX) MAIL
#
# /mail/store
#

Route::put('/mail/store',
[Controllers\MailController::class, 'store'])
->name('mail.store');

#
# (INDEX) MAIL
#
# (A) (!) AFTER (CREATE) MAIL
#
# /mail/{ string mailbox }/{ ?string search }
#

Route::get('/mail/{mailbox}',
[Controllers\MailController::class, 'index'])
->name('mail.index');

#
# (SHOW) MAIL
#
# /mail/{ int id }
#

Route::get('/mail/{mailbox}/{id}',
[Controllers\MailController::class, 'show'])
->name('mail.show');

#
# (CREATE) MEETING
#
# /meeting/create
#

Route::get('/meeting/create',
[Controllers\MeetingController::class, 'create'])
->name('meeting.create');

#
# (MY) MEETINGS
#
# /user/{ int id }/meetings
#

Route::get('/user/{id}/meetings',
[Controllers\MeetingController::class, 'index'])
->name('meeting.index');

#
# (STORE) MEETING
#
# Livewire
#

#
# (CREATE) NOTIFICATION
#
# /notification/create
#

Route::get('/notification/create',
[Controllers\NotificationController::class, 'create'])
->name('notification.create');

#
# (STORE) NOTIFICATION
#
# /notification/store
#

Route::post('/notification/store',
[Controllers\NotificationController::class, 'store'])
->name('notification.store');

#
# (CREATE) NONATTENDANCE
#
# /nonattendance/create/period/{ int period }
# create database entry
#

// (A) Name Matters
// 'timePeriod' <- {timePeriod}

Route::get('/nonattendance/create/period/{timePeriod}',
[Controllers\NonattendanceController::class, 'create'])
->name('nonattendance.create');

#
# (CREATE) NONATTENDANCE
#
# /nonattendance/create/period/{ int period }/date/{ string date }
#

Route::get('/nonattendance/create/period/{timePeriod}/date/{date}',
[Controllers\NonattendanceController::class, 'create'])
->name('nonattendance.create.date');

#
# (CREATE) NONATTENDANCE
#
# /nonattendance/create/period/{ int period }/date/{ string date }/time/{ string time }
#

Route::get('/nonattendance/create/period/{timePeriod}/date/{date}/time/{time}', [Controllers\NonattendanceController::class, 'create'])
->name('nonattendance.create.date.time');

#
# (MY) NONATTENDANCE
#
# /user/{ int id }/nonattendance
#

Route::get('/user/{id}/nonattendance',
[Controllers\NonattendanceController::class, 'index'])
->name('nonattendance.index');

#
# (CREATE) PRAISE
#
# /praise/create
#

Route::get('/praise/create/students/{students}/group/{groupId}/user/{userId}',
[Controllers\PraiseController::class, 'create'])
->name('praise.create');

#
# (MY) PRAISE
#
# /user/{ int id }/praises
#

Route::get('/user/{id}/praises',
[Controllers\PraiseController::class, 'index'])
->name('praise.index');

#
# (STORE) PRAISE
#
# /praise/store
#

Route::put('/praise/store',
[Controllers\PraiseController::class, 'store'])
->name('praise.store');

#
# SCHEDULE
#
# /user/{ int id }/schedule
#

Route::get('/user/{id}/schedule',
[Controllers\ScheduleController::class, 'index'])
->name('schedule.index');

#
# (CREATE) SCHEDULE
#
# /schedule/create/feature/{ string schoolFeature }
#

Route::get('/schedule/create/feature/{schoolFeature}',
[Controllers\ScheduleController::class, 'create'])
->name('schedule.create');

#
# (CREATE) SCHEDULE
#
# /schedule/create/feature/{ string schoolFeature }/{ int group_id }
#

Route::get('/schedule/create/feature/{schoolFeature}/group/{group_id}',
[Controllers\ScheduleController::class, 'create'])
->name('schedule.create.group');

#
# (EDIT) SCHOOL
# 
# /school/edit
#

// Anchor <a> requires GET ::get
Route::get('/school/edit',
[Controllers\SchoolController::class, 'edit'])
->name('school.edit');

#
# (UPDATE) SCHOOL
# 
# /school/update
#

Route::patch('/school/update',
[Controllers\SchoolController::class, 'update'])
->name('school.update');

#
# (CREATE) SUBJECT
#
# /subject/create
#

Route::get('/subject/create',
[Controllers\SubjectController::class, 'create'])
->name('subject.create');

#
# (STORE) SUBJECT
#
# /subject/store
#

Route::put('/subject/store',
[Controllers\SubjectController::class, 'store'])
->name('subject.store');

#
# (CREATE) USER
#
# Admin creates new user with role ...
#
# /users/{ int code }/create
#

Route::get('/user/{code}/create',
[Controllers\UserController::class, 'create'])
->name('user.create');

#
# (DESTROY) USER
#
# /user/{ int user }/destroy
#

Route::delete('/user/{user}/destroy',
[Controllers\UserController::class, 'destroy'])
->name('user.destroy');

#
# (EDIT) USER
#
# /user/{ int id }/edit
#

Route::get('/user/{id}',
[Controllers\UserController::class, 'edit'])
->name('user.edit');

#
# (INDEX) USER
#
# Admin accesses all users ...
#
# /users/{ int code }
#

Route::get('/users/{code}',
[Controllers\UserController::class, 'index'])
->name('user.index');

#
# (SHOW) USER
#
# /user/{ int id }
#

Route::get('/user/{id}',
[Controllers\UserController::class, 'show'])
->name('user.show');

#
# (STORE) USER
#
# /user/{ int code }/store
# 
# user data in Request $request
#

Route::put('/user/{code}/store',
[Controllers\UserController::class, 'store'])
->name('user.store');

#
# (UPDATE) USER
#
# /user/{ int id }/update
#

Route::patch('/user/{id}/update', [Controllers\UserController::class, 'update'])
->name('user.update');