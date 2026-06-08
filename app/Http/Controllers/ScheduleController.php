<?php

namespace App\Http\Controllers;

use App\Models\Group;

use \App\Helper\Extended\DateTime;
use \App\Helper\Enumeration\TimePeriodFilter;
use \App\Helper\Enumeration\SchoolFeature;
// GETTING SCHEDULE EDIT DATA
use App\Models\Subject;     // get subject name
use App\Models\User;        // get teacher

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
  ///////////////////////////////////////////////////////////////////////////////
  // PUBLIC

  //*****************************************************************************

  /**
   * Must but logged in
   * No need for: Authorization Policies
   */
  
  public function __construct()
  {
    $this->middleware('auth');

  }

  //*****************************************************************************

  /**
   * $user_id
   *   "user_id" name doesnt HAVE TO reflect route web.php:"id" name
   */

  public function index(int $user_id)
  {
    // view arrays
    $weekSchedule = [];

    // USER: select
    $user = User::FindOrFail($user_id);

    // GROUP: select
    $group = $user->group;

    $weekSchedule = $this->weekScheduleOf($group);

    // return user's schedule
    return view('Access.Schedule.index', [
      'user' => $user,
      'weekSchedule' => $weekSchedule
    ]);

  }

  //*****************************************************************************
  public function create(SchoolFeature $feature, $group_id = 0)
  {
    $weekSchedule = [];
    $teachers = [];
    $subjects = [];
    $groups = [];
    $group = null;
    $links = [];

    switch ($feature)
    {
      case SchoolFeature::None :

        // CURD Read database
        $groups = Group::all();

        // this line modifies datatype enum -> string
        $linkedFeature = SchoolFeature::Group->value;

        // CREATE Group links
        $links = [];
        foreach ($groups as $group)
        {
          $links[] = route('schedule.create.group', [
            $linkedFeature,
            $group->id
          ]);

        }

        break;

      case SchoolFeature::Group :

        // Find or abort(404)
        $group = Group::FindOrFail($group_id);

        $weekSchedule = $this->weekScheduleOf($group);

        // fetch all teachers (in view we want fname+lname and id)
        foreach (User::all() as $user)
          if ($user->role->name == config('role.teacher.name'))
            $teachers[] = $user;

        // fetch all subjects (in view we want abbreviation and id)
        foreach (Subject::all() as $subject)
          $subjects[] = $subject;

        break;

    }
    
    return view('Access.Schedule.create', [
      'subjects'      => $subjects,
      'teachers'      => $teachers,
      'weekSchedule'  => $weekSchedule,
      'feature'       => $feature,
      'groups'        => $groups,
      'group'         => $group,
      'links'         => $links

    ]);

  }

  ///////////////////////////////////////////////////////////////////////////////
  // PRIVATE

  //*****************************************************************************
  private function weekScheduleOf($group)
  {
    $weekSchedule = [];

    // schedule: includes name days for comparison purposes
    $days = DateTime::filterDayNames(
      DateTime::weekDays(),
      TimePeriodFilter::WeekDays,
      config('STUDY_DAYS_PER_WEEK')
    );

    // FILL: Schedule
    foreach ($days as $day)
    {
      $weekSchedule[$day] = [];
      
      foreach ($group->lessons as $lesson)
      {
        // GROUP: LESSONS

        foreach ($lesson->schedules as $schedule)
        {
          if ($schedule->dayName == $day)

          // GROUP: LESSON: SCHEDULE ENTRIES
          // (EG 2 Maths on Monday)
          // (EG 2 PEs on Tuesday)

          $weekSchedule[$day][] = [
            'start'     => $schedule->startTime->format('H:i'),
            'end'       => $schedule->endTime->format('H:i'),
            'subject'   => $lesson->subject->subjectName,
            'teacher'   => "{$lesson->teacher->fname} {$lesson->teacher->lname}"
          ];

        } // foreach schedules

      } // foreach lessons

      $weekSchedule[$day] = array_sort($weekSchedule[$day], 'start');

    } // foreach days

    return $weekSchedule;

  }

}
