<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * SubjectController Class - Goals
 * # define RESTful resource member functions
 * # coop with [view composer class] to perform additional things
 * # coop with SubjectStoreRequest::class to validate input
 */

namespace App\Http\Controllers;

use \App\Models\Subject;
use \App\Http\Requests\SubjectStoreRequest;

class SubjectController extends Controller
{
  //*****************************************************************************
  public function create()
  {
    return view('Access.Subject.create');
  }

  //*****************************************************************************
  public function store(SubjectStoreRequest $request)
  {
    $array = $request->validated();

    $status = 'status.error';
    $statusbarMessage = __('Saving failed, You can try again');

    try
    {
      $subject = new Subject();
      $subject->abbreviation  = $array['shortName'];
      $subject->subjectName   = $array['fullName'];
      if ($subject->save())
      {
        $status = 'status.ok';
        $statusbarMessage = __('Success - Subject has been added');
      }
    }
    catch (\Throwable $e)
    {
      // catch any exception
      
    }

    return back()->with([
      'status' => $status,
      'statusbarMessage' => $statusbarMessage
    ]);
  }
}
