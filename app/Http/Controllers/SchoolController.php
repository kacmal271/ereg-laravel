<?php

namespace App\Http\Controllers;

use \App\Models\School;
use \Illuminate\Http\Request;

class SchoolController extends Controller
{
  //*****************************************************************************
  public function edit()
  {
    // CONDITION: Database: schools has one record only
    $school = School::all()->first();

    return view('Access.School.edit', [
      'school' => $school
    ]);
  }

  //*****************************************************************************

  /**
   * Store School Data
   * Role: Admin
   */

  public function update(Request $request)
  {
    /**
     * Handle a school request
     * 
     * Save in Database
     * # name
     * # schoolYear
     * # logo
     *   by default: pre-inserted in database
     * # firstDay
     * # lastDay
     * (# creation date) pre-inserted in database
     * (# update date) TRIGGER handling
     */

    // STATUS BAR: Validation Fails: ok, do nothing
    $status = null;
    $statusbarMessage = null;

    // ERROR HANDLING: internal
    $schoolData = $request->validate([
      'schoolTitle'     => ['required', 'string'],
      'imageFile'       => ['nullable', 'file'],
      'academicPeriod'  => ['required', 'string', 'regex:/[\d+]{4}\/[\d+]{2}/'],
      'schoolStart'     => ['required', 'date'],
      'schoolEnd'       => ['required', 'date']

    ]);

    // ERROR HANDLING: my error handling
    try
    {
      $school = School::all()->first();
  
      $school->fill([
        'name'          => $schoolData['schoolTitle'],
        'schoolYear'    => $schoolData['academicPeriod'],
        'firstDay'      => $schoolData['schoolStart'],
        'lastDay'       => $schoolData['schoolEnd']
      ]);

      if ($schoolData['imageFile'] != null)
      {
        // USER: Admin: wants to update logo
        $school->logo = $schoolData['imageFile'];
      }

      if ($school->update())
      {
        $status = 'status.ok';
        $statusbarMessage = __('Success: School data updated');
      }
      else
      {
        throw new \Exception('Cannot Update');
      }
    }
    catch (\Exception $e)
    {
      $status = 'status.error';
      $statusbarMessage = __('Fail: Couldn\'t update, please try again');
    }

    return back()->with([
      'status' => $status,
      'statusbarMessage' => $statusbarMessage
    ]);

  }
}
