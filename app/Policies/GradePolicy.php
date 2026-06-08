<?php

namespace App\Policies;

use App\Models\Grade;
use App\Models\User;

//-----------------------------------------------------------------------------
class GradePolicy
{
  //*****************************************************************************

  /**
   * Can $viewer (Someone) view $user (Student) Grades ?
   */

  public function view(User $viewer, User $viewed) : bool
  {
    /**
     * Logic:
     *   parent can view
     *     parent can view his children ONLY
     *   student can view
     *     student can only view himself ONLY
     */

    // viewer is student
    if ($viewer->id == $viewed->id)
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
  
  /**
  * Determine whether the user can view any models.
  */
  public function viewAny(User $user) : bool
  {

  }
  
  /**
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
  public function update(User $user, Grade $grade): bool
  {
    //
  }
  
  /**
  * Determine whether the user can delete the model.
  */
  public function delete(User $user, Grade $grade): bool
  {
    //
  }
  
  /**
  * Determine whether the user can restore the model.
  */
  public function restore(User $user, Grade $grade): bool
  {
    //
  }
  
  /**
  * Determine whether the user can permanently delete the model.
  */
  public function forceDelete(User $user, Grade $grade): bool
  {
    //
  }
}
