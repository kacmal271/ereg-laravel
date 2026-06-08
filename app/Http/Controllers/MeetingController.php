<?php

namespace App\Http\Controllers;

use \App\Models\User;
use \App\Models\Meeting;

class MeetingController extends Controller
{

  //*****************************************************************************

  /**
   * Must but logged in
   * No need for: Authorization Policies
   */
  
  public function __construct()
  {
    $this->middleware('auth');

  }
  
  //***************************************************************************
  public function create()
  {
    $this->authorize('create', [Meeting::class]);

    return view('Access.Meeting.create');

  }

  //***************************************************************************
  public function index(int $user_id)
  {
    $user = User::findOrFail($user_id);

    return view('Access.Meeting.index', [
      'user' => $user
    ]);

  }
}
