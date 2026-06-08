<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * UserPickerRule Class - Goals
 * # assert UserPicker Class provides at least 1 valid user id
 */

namespace App\Rules;

// My Declarations
use App\Livewire\UserPicker;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UserPickerRule implements ValidationRule
{
  /**
  * Run the validation rule.
  *
  * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
  */
  public function validate(string $attribute, mixed $value, Closure $fail): void
  {
    $ids = [];
    preg_match_all(UserPicker::getIdFormat(), $value, $ids);

    if (count($ids[1]) == 0)
    {
			// ( Think: Localization, lang/pl/validation )
			$fail(__('validation.custom.users.format'));
    }
  }
}
