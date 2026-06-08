<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
* SubjectStoreRequest Class - Goals
* # coop with SubjectController::class to validate input
*/

namespace App\Http\Requests;

use \App\Models\Subject;
use \Illuminate\Foundation\Http\FormRequest;

class SubjectStoreRequest extends FormRequest
{
  //*****************************************************************************

  /**
   * desc
   *   inline Authorization Policy (Good Practise)
   * 
   * Determine if the user is authorized to make this request.
   */

  public function authorize(): bool
  {
    return auth()->user()->can('create', [Subject::class]);
  }

  //*****************************************************************************
  
  /**
   * desc
   *   Validator rules and Custom Rules
   * 
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */

  public function rules(): array
  {
    return [
      'fullName' => ['required', 'string', 'max:255', 'regex:/.*[a-zA-z].*/'],
      'shortName' => ['required', 'string', 'max:255', 'regex:/.*[a-zA-z].*/'],

    ];
  }
}
