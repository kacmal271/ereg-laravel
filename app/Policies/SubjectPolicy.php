<?php

namespace App\Policies;

use App\Models\User;

class SubjectPolicy
{

  //*****************************************************************************

  /**
   * Create a new policy instance.
   */

  public function __construct()
  {
    //
  }
  
  //*****************************************************************************

  /**
   * Determine whether the user can create models.
   */

  public function create(User $user): bool
  {
    $can = $user->role->code;
    $can &= config('role.admin.code');
    return $can > 0;
  }
}
