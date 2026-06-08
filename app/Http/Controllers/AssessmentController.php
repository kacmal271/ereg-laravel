<?php

namespace App\Http\Controllers;

use \App\Models\Assessment;

class AssessmentController extends Controller
{
  //*****************************************************************************
  public function store()
  {
    $assessmentsData = request()->validate([
      'assessmentName' => [
        'required', 'string', 'unique:assessments,name', 'alpha', 'max:255'
      ],
      'assessmentValue' =>
        // required, non-negative integer
        array_merge(['required'], config('validator.integer.nonNegative'))
    ]);

    $assessment = new Assessment();
    $assessment->name = $assessmentsData['assessmentName'];
    $assessment->value = $assessmentsData['assessmentValue'];

    $status = $assessment->save(); // : bool

    return back();
  }

  //*****************************************************************************
  public function create()
  {
    $assessments = Assessment::all();

    return view('Access.Assessment.create', [
      'assessments' => $assessments
    ]);
  }
}
