<?php

namespace App\Policies;

use App\Models\Praise;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PraisePolicy
{
  /**
  * Determine whether the user can view any models.
  */
  public function viewAny(User $user, User $owner): bool
  {
    if ($user->id == $owner->id)
    {
      // student views his nonattendances
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
  
  /**
  * Determine whether the user can view the model.
  */
  public function view(User $user, Praise $praise): bool
  {
    //
  }
  
  /**
  * Determine whether the user can create models.
  */
  public function create(User $user): bool
  {
    //
  }
  
  /**
  * Determine whether the user can update the model.
  */
  public function update(User $user, Praise $praise): bool
  {
    //
  }
  
  /**
  * Determine whether the user can delete the model.
  */
  public function delete(User $user, Praise $praise): bool
  {
    //
  }
  
  /**
  * Determine whether the user can restore the model.
  */
  public function restore(User $user, Praise $praise): bool
  {
    //
  }
  
  /**
  * Determine whether the user can permanently delete the model.
  */
  public function forceDelete(User $user, Praise $praise): bool
  {
    //
  }
}
