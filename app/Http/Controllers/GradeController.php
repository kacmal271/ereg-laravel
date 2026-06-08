<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * 
 */

namespace App\Http\Controllers;

use App\Helper\Enumeration\SchoolFeature;
use App\Helper\Statistics;
use App\Helper\ServerDatabaseConversion;
use App\Models\Subject;
use App\Models\Group;
use App\Models\User;
use App\Models\Grade;

//-----------------------------------------------------------------------------
class GradeController extends Controller
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
   * $feature
   *   name is used deliberately
   *   $schoolFeature causes Enum Binding error
   */

  public function create(SchoolFeature $feature, $group_id = null, $subject_id = null)
  {
    // AUTHORIZATION POLICY
    if ( ! auth()->user()->can('create', [Grade::class]))
    {
      abort(abort(403));
    }

    $group = $group_id == null
      ? null
      : Group::all()->where('id', '=', $group_id)->first();

    $subject = $subject_id == null
      ? null
      : Subject::all()->where('id', '=', $subject_id)->first();

    $groups = []; // dont null -> foreach breaks on null
    $subjects = [];
    $links = [];

    switch ($feature)
    {

      case SchoolFeature::None :

        // CHANGE $period::BackedEnum to from links
        $myFeature = SchoolFeature::Group->value;

        foreach (auth()->user()->lessons->unique('group') as $lesson)
        {
          // get groups
          $groups[] = $lesson->group;

          // get clickable links
          $links[] = route('grades.create', [
            // plug in Enum as Enum::value
            'schoolFeature' => $myFeature,
            'group' => $lesson->group->id,
            'subject' => 0
          ]);
        }

        break;

      case SchoolFeature::Group :

        // CHANGE $period::BackedEnum to from links
        $myFeature = SchoolFeature::Subject->value;
        
        foreach (auth()->user()->lessons as $lesson)
        {

          // dismiss wrong group
          if ($lesson->group->id != $group->id)
          {
            continue;
          }

          // get subjects
          $subjects[] = $lesson->subject;

          // get clickable links
          $links[] = route('grades.create', [
            // plug in Enum as Enum::value
            'schoolFeature' => $myFeature,
            'group' => $group->id,

            // subject may repeat twice
            // if given teacher has given subject twice with given class
            // despite it being wierd
            'subject' => $lesson->subject->id
          ]);
        }

        break;

      case SchoolFeature::Subject :

        // (A) just return the Livewire View

        break;

    }
    
    // (A)
    return view('Access.Grade.create', [
      // to livewire view
      'subject' => $subject,
      'group' => $group,
      // to laravel view
      'links' => $links,
      'feature' => $feature,
      'groups' => $groups,
      'subjects' => $subjects
    ]);
  }

  //*****************************************************************************
  public function index(int $userId, int $isStatistics)
  {
    // GET User object
    $user = User::FindOrFail($userId);
    
    // PROTECT Grades listing access
    if (auth()->user()->cannot(   // viewer
      'view',                     // function name
      [
        Grade::class,             // policy of model
        $user                     // viewed
      ]
    ))
      // 403 Forbidden
      abort(403, __('Unauthorized'));

    // GET View data
    extract($this->getGradeData($user));

    // RETURN VIew data
    // Relative Path: \root\resources\views\[here]
    return view('Access.Grade.index', [
      'user' => $user,
      'isStatistics' => $isStatistics,
      'hasGrades' => $hasGrades,
      'meansWeightedRaw' => $meansWeightedRaw,
      'meansWeightedFormatted' => $meansWeightedFormatted,
      'subjects' => $subjects,
      'weights' => $weights,
      'grades' => $grades
    ]);

  }

  ///////////////////////////////////////////////////////////////////////////////
  // PRIVATE

  private function getGradeData($user) : array
  {
    $data = [
      'hasGrades' => [],  // User has grades
      'meansWeightedRaw' => [],
      'meansWeightedFormatted' => [],
      'subjects' => [],
      'weights' => [],
      'grades' => []
    ];
    
    foreach ($user->group->lessons as $lesson)
    {
      // this user's subject

      $data['subjects'][] = $lesson->subject->abbreviation;

      // prepare this subject's grades-weights pairs
      $weightsOfLesson = [];
      $gradesOfLesson = [];

      foreach ($user->grades as $grade)
      {

        // this user's subject's grade
        if ($lesson->subject->abbreviation == $grade->subject->abbreviation)
        {
          // sets product: of all user grades per each lesson they attend
          
          $weightsOfLesson[] = $grade->assessment->value;
          $gradesOfLesson[] = $grade->grade;

        }

        else

          // sets product: empty set
          continue;

      } // foreach $grade

      // view grades-weights pairs
      $data['weights'][] = $weightsOfLesson;
      $data['grades'][] = $gradesOfLesson;

      // Handle Exception: student has no grades
      $gradesIndex = count($data['grades']) - 1;
        // Check: last added Array (is it empty?)
      if (count($data['grades'][$gradesIndex]) == 0)
      {
        $data['hasGrades'][] = false; // User has no grades

        $data['meansWeightedRaw'][] = 0.0;

        $data['meansWeightedFormatted'][] = '0';

      }
      else
      {
        $data['hasGrades'][] = true; // User has grades

        // view: means weighted raw
        $data['meansWeightedRaw'][] = Statistics::meanWeighted(
          $gradesOfLesson, $weightsOfLesson
        );

        // view: means weighted formatted
        $data['meansWeightedFormatted'][] = ServerDatabaseConversion::formatGrade(
          // last appended element
          $data['meansWeightedRaw'][count($data['meansWeightedRaw']) - 1]
        );

        // [DEBUG]
        // dump($data);

      }

    } // foreach $lesson

    // return array of data
    return $data;

  }

}
