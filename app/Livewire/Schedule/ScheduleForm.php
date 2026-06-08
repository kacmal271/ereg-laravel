<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Table of Contents
 * #
 * 
 * Note
 * # time is normalized:   hh::mm   in this component
 *   \DateTime is normalized: ->format('H:i')
 */

namespace App\Livewire\Schedule;

use App\Models\Schedule;
use App\Models\Lesson;

use Livewire\Component;

//-----------------------------------------------------------------------------
class ScheduleForm extends Component
{
  ///////////////////////////////////////////////////////////////////////////////
  // PUBLIC

  // properties not hydrated into subsequest requests, why ?
  public $teacherId;
  public $subjectId;
  public $startTime;
  public $endTime;
  public $weekDay;        // pass variable Laravel View -> Livewire View
  public $daySchedule;    // pass variable Laravel View -> Livewire View
  public $group;          // pass variable Laravel View -> Livewire View
  public $teachers;       // pass variable Laravel View -> Livewire View
  public $subjects;       // pass variable Laravel View -> Livewire View

  //*****************************************************************************
  // MOUNT ~ CONSTRUCTOR
  // called after component created
  // can pass any variables from Laravel View <livewire />
  public function mount($subjects, $teachers)
  {
    if (! empty($subjects))
    // init wire:model subjectId
      $this->subjectId = $subjects[0]->id;

    if (! empty($teachers))
    // init wire:model teacherId
      $this->teacherId = $teachers[0]->id;

  }

  //*****************************************************************************
  public function render()
  {
    return view('livewire.schedule.schedule-form');

  }

  //*****************************************************************************
  public function store()
  {
    // SQL LESSON: Check if Lesson not exists
    //      check by   subject_id, group_id, teacher_id   congregation
    
    // SQL LESSON: query builder
    $where = "subject_id = {$this->subjectId}";
    $where .= " and group_id = {$this->group->id}";
    $where .= " and user_id = {$this->teacherId}";
    $lesson = Lesson::whereRaw($where);
    
    // SQL LESSON: lessons collection  -> lesson model
    $lesson = $lesson->get();

    if ($lesson->isNotEmpty())
    {
    // SQL LESSON: Lesson exists

      $lesson = $lesson[0];

    }
    else
    {
    // SQL LESSON: Lesson doesnt exist

      $lesson = new Lesson();
      $lesson->fill([
        'subject_id'    => $this->subjectId,
        'group_id'      => $this->group->id,
        'user_id'       => $this->teacherId
      ]);
      $lesson->save();

    }

    $newScheduleEntry = new Schedule();
    $newScheduleEntry->fill([
      'lesson_id'       => $lesson->id,
      'startTime'       => $this->startTime,
      'endTime'         => $this->endTime,
      'dayName'         => $this->weekDay
    ]);
    $newScheduleEntry->save();

    // [TODO] Laravel Exception Handling
    // VIEW: Updating view
    if (! isAnyNull([$lesson, $newScheduleEntry]))
    // VIEW: All models exist
      $this->updateScheduleTable(
        $this->startTime,
        $this->endTime,
        $lesson->subject->subjectName,
        "{$lesson->teacher->fname} {$lesson->teacher->lname}"
      );

  }
  
  ///////////////////////////////////////////////////////////////////////////////
  // PRIVATE

  //*****************************************************************************
  private function updateScheduleTable(
    $startTime,
    $endTime,
    $subjectName,
    $teacherName
  )
  {
    // UPDATE: Livewire property

    $this->daySchedule[] = [
      'start'     => date_create($startTime)->format('H:i'),
      'end'       => date_create($endTime)->format('H:i'),
      'subject'   => $subjectName,
      'teacher'   => $teacherName
    ];

    // SORT:

    $this->daySchedule = array_sort($this->daySchedule, 'start');

  }

}
