<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * [TODO]
 * # validate $group as new GroupRule
 * # validate $subject as new SubjectRule // (A)
 */

namespace App\Livewire\Grade;

use \App\Models\Grade;
use \App\Models\Assessment;
use Livewire\Component;

class GradeForm extends Component
{
  public $status = null;
  public $statusbarMessage = null;
  public $assessmentId = 1;
  public $newGrade = [];

  // passed from Laravel View
  public $group;
  public $subject;

  /////////////////////////////////////////////////////////////////////////////
  // LIVEWIRE

  //***************************************************************************
  public function render()
  {
    return view('livewire.grade.grade-form', [
      'statusbarMessage' => $this->statusbarMessage,
      'status' => $this->status,
      'assessments' => Assessment::all(),
    ]);
  }

  /////////////////////////////////////////////////////////////////////////////
  // PUBLIC

  //***************************************************************************
  public function store()
  {
    $validated = $this->validate([
      // non-negative integer
      'assessmentId' => ['required', 'numeric', 'integer', 'not_regex:/^-/'],
      'newGrade.*.userId' => ['required', 'numeric', 'integer', 'not_regex:/^-/'],
      'newGrade.*.grade' => ['numeric', 'not_regex:/^-/', 'min:0', 'max:6']
    ]);

    // clear input fields
    $this->clearInputFields();

    foreach ($validated['newGrade'] as $newGrade)
    {
      if ( ! isset($newGrade['grade']))
      {
        continue;
      }

      try
      {
        // create new Model:Grade
        $grade = new Grade();
        // [TODO] (A)
        // I dont know if $subject hasnt been modified
        // after all Alpine.js works in the Client domain
        $grade->subject_id = $this->subject->id;
        $grade->assessment_id = $validated['assessmentId'];
        $grade->user_id = $newGrade['userId'];
        $grade->grade = $newGrade['grade'];
  
        if ( ! $grade->save())
        {
          throw new \Exception();
        }
      }
      catch(\Exception $e)
      {
        $this->handleStatusbar($grade->user_id);
        return;
      }

      $this->handleStatusbar();
    }
  }

  /////////////////////////////////////////////////////////////////////////////
  // PRIVATE

  //***************************************************************************

  /**
   * desc
   *   those that you want to clear C:
   */

  private function clearInputFields()
  {
    foreach ($this->newGrade as $key => $value)
    {
      unset($this->newGrade[$key]['grade']);
    }
  }

  //***************************************************************************
  private function handleStatusbar($userId = null)
  {
    if ($userId != null)
    {
      $this->status = 'status.error';
      $this->statusbarMessage = __('Saving failure on: ') . "ID=$userId";
      return;
    }
    else
    {
      $this->status = 'status.ok';
      $this->statusbarMessage = __('Success - Grades have been added');
    }
  }
}
