<?php

namespace App\Http\Controllers;

use App\Models\Group;

class GroupController extends Controller
{
  //*****************************************************************************
  public function store()
  {
    $groupData = request()->validate([
      'className' => [
        'required', 'string', 'unique:groups,name', 'alpha_num', 'max:3'
      ]
    ]);

    $group = new Group();
    $group->name = $groupData['className'];

    $status = $group->save();

    return back()->with([
      'status' => $status ? 'status.ok' : 'status.error',
      'statusbarMessage' => $status
        ? __('Success: Class added')
        : __('Error: Please try adding class again')
    ]);
  }

  //*****************************************************************************
  public function create()
  {
    return view('Access.Group.create');
  }
}
