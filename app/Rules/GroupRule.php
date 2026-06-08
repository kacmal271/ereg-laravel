<?php

namespace App\Rules;

// my declarations
use \App\Models\Group;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class GroupRule implements ValidationRule
{
  /**
  * Run the validation rule.
  *
  * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
  */
  public function validate(string $attribute, mixed $value, Closure $fail): void
  {
    $groups = Group::all();
    foreach ($groups as $group)
    {
      if ($value == $group->id)
      {
        return;
      }
    }

		// ( Think: Localization, lang/pl/validation )
    $fail(__('validation.custom.group.invalid'));
  }
}
