<?php

namespace App\Policies;

use App\Models\Nonattendance;
use App\Models\User;

class NonattendancePolicy
{
  //*****************************************************************************

  /**
   * desc
   *   view any of THIS STUDENT'S MODELS
   * 
   * Determine whether the user can view any models.
   */

  public function viewAny(User $user, User $owner): bool
  {
    if ($user->id == $owner->id)
    {
      // student views his nonattendances
      return true;
    }

    if ($user->role->name == config('role.admin.name'))
    {
      // admin can view
      return true;
    }

    if ($user->role->name == config('role.parent.name'))
    {
      if ($user->children == null)
      {
        // parent without children shouldnt even exist in the first place
        return false;
      }

      foreach ($user->children as $child)
      {
        if ($child->id == $owner->id)
        {
          // ktores z dzieci parenta to dziecko żądane
          // parent can view his child
          return true;
        }
      }
    }

    return false;
  }

  //*****************************************************************************
  
  /**
   * desc
   *   think: this specific GROUP of Models that $user can view
   *   although here we only check one
   *   there can be more
   * 
   * Determine whether the user can view the model.
   */

  public function view(User $viewer, Nonattendance $nonattendance)
  {
    //
  }
  
  //*****************************************************************************

  /**
   * $user
   *   auth()->user()
   * Determine whether the user can create models.
   */

  public function create(User $user): bool
  {
    $can = $user->role->code;
    $can &= config('role.teacher.code');
    return $can > 0;
  }
  
  /**
  * Determine whether the user can update the model.
  */
  public function update(User $user, Nonattendance $nonattendance): bool
  {
    //
  }
  
  /**
  * Determine whether the user can delete the model.
  */
  public function delete(User $user, Nonattendance $nonattendance): bool
  {
    //
  }
  
  /**
  * Determine whether the user can restore the model.
  */
  public function restore(User $user, Nonattendance $nonattendance): bool
  {
    //
  }
  
  /**
  * Determine whether the user can permanently delete the model.
  */
  public function forceDelete(User $user, Nonattendance $nonattendance): bool
  {
    //
  }
}
