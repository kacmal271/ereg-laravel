<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
  //*****************************************************************************
  public function __construct()
  {
    //
  }

  //*****************************************************************************

  /**
   * Can $user create new user ?
   */

  public function create(User $user) : bool
  {
    if (($user->role->code & config('role.admin.code')) > 0)
    {
      return true;
    }

    return false;

  }

  //*****************************************************************************

  /**
   * Can $viewer click button [edit] on $viewed ?
   */

  public function edit(User $viewer, User $viewed) : bool
  {
    if ($viewer->id == $viewed->id)
    {
      return true;
    }

    if (($viewer->role->code & config('role.admin.code')) > 0)
    {
      return true;
    }

    return false;

  }

  //*****************************************************************************

  /**
   * Can $viewer see everybody ?
   */

  public function index(User $viewer) : bool
  {
    return ($viewer->role->code & config('role.admin.code')) > 0;
  }

  //*****************************************************************************

  /**
   * Can $viewer view $viewed ?
   */

  public function show(User $viewer, User $viewed) : bool
  {
    // viewer is student
    if ($viewer->id == $viewed->id)
    {
      return true;
    }
    
    if ($viewer->role->name == config('role.admin.name'))
    {
      return true;
    }

    if ($viewer->role->name == config('role.parent.name'))
    {
      // viewer is parent
      foreach ($viewer->children as $child)
      {
        // get each child
        if ($child->id == $viewed->id)
        {
          // viewed is parent's child
          return true;
        }
      }

    }

    return false;
  }
}
