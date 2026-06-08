<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * This Class - Goals
 * # register Protection Policy
 */

namespace App\Providers;

use Illuminate\Support\Facades\Gate;

use App\Policies\MeetingPolicy;
use App\Models\Meeting;
use App\Policies\PraisePolicy;
use App\Models\Praise;
use App\Policies\NonattendancePolicy;
use App\Models\Nonattendance;
use App\Policies\UserPolicy;
use App\Models\User;
use App\Policies\GradePolicy;
use App\Models\Grade;
use App\Policies\NotificationPolicy;
use App\Models\Notification;
use App\Models\Subject;
use App\Policies\SubjectPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

//-----------------------------------------------------------------------------
class AuthServiceProvider extends ServiceProvider
{
  /**
  * The model to policy mappings for the application.
  *
  * @var array<class-string, class-string>
  */
  protected $policies = [
    
  ];
  
  //*****************************************************************************
  /**
  * Register any authentication / authorization services.
  */
  public function boot(): void
  {
    Gate::policy(Meeting::class, MeetingPolicy::class);
    Gate::policy(Praise::class, PraisePolicy::class);
    Gate::policy(Subject::class, SubjectPolicy::class);
    Gate::policy(Notification::class, NotificationPolicy::class);
    Gate::policy(Nonattendance::class, NonattendancePolicy::class);
    Gate::policy(User::class, UserPolicy::class);
    Gate::policy(Grade::class, GradePolicy::class);
    $this->registerPolicies();

  }

}
