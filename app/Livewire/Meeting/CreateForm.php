<?php

namespace App\Livewire\Meeting;

use App\Models\Meeting;
use App\Helper\Enumeration\Status;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateForm extends Component
{
  /**
   * Enable Live Validation
   *   Validate Attribute
   *   input wire model blue|live
   */

  #[Validate]
  public $grupaId;

  #[Validate]
  public $nazwa;

  #[Validate]
  public $opis;

  #[Validate]
  public $kiedy;

  #[Validate]
  public $odKtorej;

  #[Validate]
  public $doKtorej;

  //*****************************************************************************
  public function render()
  {
    $groups = auth()->user()->groups();

    try
    {
      // set default value
      $this->grupaId = $groups->first()->id;
    }
    catch (\Throwable $e)
    {
      $this->grupaId = null;
    }

    return view('livewire.meeting.create-form', [
      'groups' => $groups
    ]);
  }
  //*****************************************************************************

  /**
   * desc
   *   validated rules CAN (dont have to) be stored conveniently
   */

  public function rules()
  {
    return [
      'grupaId' => array_merge(['required'], config('validator.integer.nonNegative')),
      'nazwa' => ['required', 'string', 'max:255'],
      'opis' => ['nullable', 'string', 'max:65535'],
      'kiedy' => ['required', 'date_format:Y-m-d'],
      'odKtorej' => ['required', 'date_format:H:i'],
      'doKtorej' => ['required', 'date_format:H:i']
      
    ];
  }

  //*****************************************************************************

  /**
   * desc
   *   INSERT INTO 1 RECORD
   */

  public function store()
  {
    $validated = $this->validate();

    $meeting = new Meeting();
    $meeting->fill([
      'user_id'               => auth()->user()->id,
      'group_id'              => $validated['grupaId'],
      'meetingName'           => $validated['nazwa'],
      'meetingDescription'    => $validated['opis'],
      'startTime'             => $validated['kiedy'] . ' ' . $validated['odKtorej'],
      'endTime'               => $validated['kiedy'] . ' ' . $validated['doKtorej']
    ]);

    if ($meeting->save())
    {
      session()->flash('status', Status::Ok);
    }
    else
    {
      session()->flash('status', Status::Error);
    }

  }

}
