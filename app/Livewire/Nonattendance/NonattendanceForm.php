<?php

namespace App\Livewire\Nonattendance;

use Livewire\Component;

//-----------------------------------------------------------------------------
class NonattendanceForm extends Component
{
  public $data;
    /**
      * array $data
      *
      * // ( See: app\Http\Controllers\NonattendanceController.php )
      * 
      * [
      *   0 => [
      *     "studentData" => [
      *       "id" => 7
      *       "fN" => "Boleslaw"
      *       "lN" => "Krzywousty"
      *       "isPresent" => false
      *       "isExcused" => true
      *     ],
      *     "schedule" => App\Models\Schedule,
      *     "date" => "2024-08-13"
      *   ]
      * ]
      *
      * (A) Get from LARAVEL Controller
      * 
    */

  //*****************************************************************************
  public function render()
  {
    return view('livewire.nonattendance.nonattendance-form');

  }

  //*****************************************************************************
  // (DONE) My Function
  public function store()
  {
    // maybe we: create new nonattendance
    // maybe we: have to update old one
    // ¯\_(ツ)_/¯
    
    foreach ($this->data as $nonattendance)
    {
      //   #1 find if such Nonattendance Record already exists

      $nonattendanceRecord = \App\Models\Nonattendance::whereRaw(
        // date in year ...
        // Note: startTime is accessed via schedules table
        "nonattendanceWhen  = '{$nonattendance['date']}' and " .
        // day of week, start hour, end hour ...         
        "schedule_id        = '{$nonattendance['schedule']->id}' and " .
        // specific student ...  
        "user_id            = '{$nonattendance['studentData']['id']}'"
      )->get();

      // ... uniquely identify Nonattendance Record

      if ($nonattendanceRecord->isNotEmpty())
      {
        //   #2 if EXISTS, update/delete it

        // Collection into NonattendanceModel
        $nonattendanceRecord = $nonattendanceRecord[0];

        if ($nonattendance['studentData']['isPresent'] === true)
        {
          // delete
          $nonattendanceRecord->delete();
          continue;

        }

        if ($nonattendance['studentData']['isExcused'] != $nonattendanceRecord->isExcused)
        {
          // update
          $nonattendanceRecord->isExcused = $nonattendance['studentData']['isExcused'];
          $nonattendanceRecord->update();
          continue;

        }

      } // Record EXISTS

      else
      {
        //   #3 if NOT EXISTS, create it / continue
  
        if (! $nonattendance['studentData']['isPresent'])
        {
          // isnt Present

          // create

          $newNonattendance = new \App\Models\Nonattendance();
          $newNonattendance->fill([
            'user_id'                 => $nonattendance['studentData']['id'],
            'isExcused'               => $nonattendance['studentData']['isExcused'],
            'schedule_id'             => $nonattendance['schedule']->id,
            'nonattendanceWhen'       => $nonattendance['date'],
      
          ]);

          $newNonattendance->save();

        } // isnt Present

      } // Record NOT EXISTS

    } // foreach

  }

}
