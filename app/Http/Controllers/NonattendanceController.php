<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Table of Contents
 * # CANNOT PAGINATE ARRAY
 */

namespace App\Http\Controllers;

use App\Models\User;
use App\Helper\Extended\DateTime;
use App\Models\Nonattendance;
use App\Models\School;
use App\Helper\Enumeration\TimePeriod;

class NonattendanceController extends Controller
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
   * TimePeriod $period has route-bind set
   *  asserts enum stays enum
   *  prevents enum trying to instantiate from int
   *  ( See: ROUTE MODEL BINDING | web.php )
   * return: view
   * description: return view + array of strings with dates
   *    dates to be displayed to Teacher
   *    dates that are clickable <a>
   */
  
  public function create(TimePeriod $period, $date = '', $time = '')
  {
    $canCreate = auth()->user()->can('create', [Nonattendance::class]);
    if ( ! $canCreate)
    {
      abort(abort(403));
    }

    // compiler: must define in create() scope
    $data = [];
    
    // compiler: assert 'links' slug is never null
    $data['links'] = [];

    switch ($period)
    {

      case TimePeriod::None :

        // Teacher: [2024-10-09]
        $timestamps = $this->getDays();

        // CHANGE $period::BackedEnum to form links
        $myPeriod = TimePeriod::Day->value;

        // APPEND years and links 4 View
        
        foreach ($timestamps as $myDate) // (A) every iteration new date
        {
          // APPEND next year:month:day 4 View

          $datetime = date_create($myDate);

          $year   = $datetime->format('Y');  // 2024
          $month  = $datetime->format('M');  // Aug
          $day    = $datetime->format('d');  // 30

          $myDateTime = new DateTime();

          if ( ! $myDateTime->isValidWeekDay($datetime->format('D'))) // Thu
            // school operates Mon-Fri or other
            // ∴ dont add Sat-Sun or other
            continue;

          $data['timestamps'][$year][$month][] = $day;  // (A) every iteration new date

          // (B) Sort CaLendAr-wise
          // I want: 0 => "01"
          // "01" is PHP good
          sort($data['timestamps'][$year][$month]);

          // APPEND next link 4 View

          // days are <a> links to user
          $data['links'][$year][$month][]  = "/nonattendance/create/period/{$myPeriod}/date/{$myDate}";
          // (B) Keep consistency
          sort($data['links'][$year][$month]);

        }

        // [TODO] PAGINATION: paginate $data array

        // count(timestamps) == count(links)
        // remember this

        break;

      case TimePeriod::Day :
        
        // Teacher: [08:45]
        
        $data['hours'] = $this->getHours($date);

        // CHANGE $period::BackedEnum now
        $myPeriod = TimePeriod::Hour->value;

        foreach ($data['hours'] as &$hour)
        {
          // days are <a> links to user
          $data['links'][]  = "/nonattendance/create/period/{$myPeriod}/date/{$date}/time/$hour";

          // neatify $data format, [08:00:00 -> 08:00]
          $hour = date_create($hour)->format('h:i');

        }
        
        break;

      case TimePeriod::Hour :
        
        // Teacher: 14 Jan Kowalski [x]

        $data = $this->getNonattendanceData($date, $time);

        break;

    }
		
    // return $data array
    return view('Access.Nonattendance.create', [
      'period' => $period,
      'data' => $data
    ]);

  }

  //*****************************************************************************
  
  /**
   * TimePeriod $period has route-bind set
   *  asserts enum stays enum
   *  prevents enum trying to instantiate from int
   *  ( See: ROUTE MODEL BINDING | web.php )
   * return: view
   * description: return view + array of strings with dates
   *    dates to be displayed to Teacher
   *    dates that are clickable <a>
   */
  
  public function index($id)
  {
    $user = User::findOrFail($id);

    if (auth()->user()->cannot('viewAny', [
      Nonattendance::class,
      $user
    ]))
    {
      abort(403);
    }

    $nonattendances = Nonattendance::all()
      ->where('user_id', '=', $id)
      ->sortBy('orderBy', 1);

    $nonattendancesCalendar = [];

    foreach ($nonattendances as $nonattendance)
    {
      $year = $nonattendance->nonattendanceWhen->format('Y');
      $month = $nonattendance->nonattendanceWhen->format('M');

      $nonattendancesCalendar[$year][$month][] = $nonattendance;
    }

    // return $data array
    return view('Access.Nonattendance.index', [
      // parent select bar
      'user' => $user,
      'nonattendancesCalendar' => $nonattendancesCalendar
    ]);

  }
  
  ///////////////////////////////////////////////////////////////////////////////
  // PRIVATE

  //*****************************************************************************
  private function isPresent($student, $schedule, $date)
  {
    // context matters
    // Specific Nonattendance
    // of this perticular student
    // at this particular schedule lesson,
    // at this particular date
    // AT THIS PARTICULAR HOUR
    $nonattendance = Nonattendance::whereRaw(
      "user_id = {$student->id}" .
      " and schedule_id = {$schedule->id}" .
      " and nonattendanceWhen = '$date'"
    )->get();

    // is present when no nonattendance record found
    return count($nonattendance) == 0;

  }

  //*****************************************************************************
  private function isExcused($student, $schedule, $date)
  {
    // context matters
    // Specific Nonattendance Excuse
    // of this perticular student
    // at this particular schedule lesson,
    // at this particular date
    // AT THIS PARTICULAR HOUR
    $nonattendance = Nonattendance::whereRaw(
      "user_id = {$student->id}" .
      " and schedule_id = {$schedule->id}" .
      " and nonattendanceWhen = '$date'"
    )->get();
    
    if (count($nonattendance) == 0)
      // Present Student doesnt need be excused ¯\_(ツ)_/¯
      return false;

    // is present when no nonattendance record found
    return $nonattendance[0]->isExcused;

  }

  //*****************************************************************************

  /**
   * $date = '2024-08-13', ..
   * $dayName = 'Monday', 'friday', ..
   */

  private function isDateWeekDay(string $date, string $dayName) : bool
  {
    // get current day name
    $curDay = date_create($date)->format('l');
    
    // compare if schedule day matches current day
    if (strtolower($curDay) == strtolower($dayName))
      return true;

    return false;

  }

  //*****************************************************************************
  private function getNonattendanceData($date, $time)
  {
    $data     = [];
    
    foreach (auth()->user()->lessons as $lesson)
    {
      // TEACHER -> LESSONS
      foreach ($lesson->schedules as $schedule)
      {
        // TEACHER -> LESSONS -> SCHEDULES
        // single lesson may be twice per day
        // such is the nature of a lesson as manifested by the schedule

        if ($this->isDateWeekDay($date, $schedule->dayName))

          // TEACHER -> LESSONS -> SCHEDULES -> only this week day

          if ($schedule->startTime->format('h:i:s') == $time)

            // TEACHER -> LESSONS -> SCHEDULES -> only this week day -> only this hour

            foreach ($lesson->group->students as $student)
            {
            
              // TEACHER -> LESSONS -> SCHEDULES -> only this week day -> only this hour -> group's students

              $data[] = [
                'studentData' => [
                  'id'          => $student->id,
                  'fN'          => $student->fname,
                  'lN'          => $student->lname,
                  // get data on nonattendance
                  // used in Livewire Nonattendance Form
                  'isPresent'   => $this->isPresent($student, $schedule, $date),
                  // get data on nonattendance excuse too
                  'isExcused'   => $this->isExcused($student, $schedule, $date)
                ],
                
                'schedule' => $schedule,
                'date' => $date

              ];

            }
        
      } // foreach schedules

    } // foreach lessons

    return $data;

  }

  //*****************************************************************************
  private function getHours($date)
  {
    $hours     = [];

    foreach (auth()->user()->lessons as $lesson)
    { 
      // GETTING HOURS
      foreach ($lesson->schedules as $schedule)
      {
        // FILTERING HOURS
        // compare if schedule day matches current day
        // NOTE: change NAMESPACE to $this
        if ($this->isDateWeekDay($date, $schedule->dayName))
        {
          $datetime = $schedule->startTime;
          $hours[] = $datetime->format('h:i:s');

        }

      }

      // $hours has matching day's teacher's hours

    }

    // 09:00:00, 10:00:00, ..
    sort($hours);

    // RETURNING HOURS
    return $hours;

  }

  //*****************************************************************************
  private function getDays() : array
  {
    $days       = [];
    $curDay     = new \DateTimeImmutable();

    // * schools table seeder
    $firstDay = School::all()->first()->firstDay;
    
    while (date_diff($firstDay, $curDay)->format('%R') == '+')
    {
      $days[] = date_format($curDay, 'Y-m-d');

      // curDay >= firstDay
      $curDay = $curDay->add(\DateInterval::createFromDateString('-1 day'));

    }

    // return $days array
    return $days;

  }

}
