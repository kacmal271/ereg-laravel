<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * This File - Goals
 * # declare markup -> Basic Routes -> Person:Student
 */

?>

<div class="single p-0 navigation-vertical">

  <!-- NOT FLEXBOX -->
  <!-- NOT FLEX ITEMS -->

  {{-- SELECT ACTIVE PAGE --}}

  <?php

  // mailbox
  use App\Helper\Enumeration\Mailbox;

  use Illuminate\Support\Facades\Route;

  ?>

  <!-- default: (My) GRADE -->

  <a  class="button button-route navigation-vertical-element bt-1 bb-1
             @if (Route::currentRouteName() == 'grades.index') active @endif"
      href="{{ route('grades.index', [
        'id' => auth()->user()->id,
        'isStatistics' => ($isStatistics ?? 0)]) }}">
      {{ __("My Grades") }}
    
  </a>

  <!-- My Data -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'user.show') active @endif"
      href="{{ route('user.show', ['id' => auth()->user()->id]) }}">
      {{ __("My Data") }}
    
  </a>

  <!-- SCHEDULE -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'schedule.index') active @endif"
      href="{{ route('schedule.index', ['id' => auth()->user()->id]) }}">
      {{ __("Schedule") }}
    
  </a>

  <!-- (MY) NONATTENDANCE -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'nonattendance.index') active @endif"
      href="{{ route('nonattendance.index', ['id' => auth()->user()->id]) }}">
      {{ __("My Nonattendance") }}
    
  </a>

  <!-- PRAISES AND NOTICES -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'praise.index') active @endif"
      href="{{ route('praise.index', ['id' => auth()->user()->id]) }}">
      {{ __("Praises and Notices") }}
    
  </a>

  <!-- MAIL -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'mail.index') active @endif"
      href="{{ route('mail.index', ['mailbox' => Mailbox::Inbox->value]) }}">
      {{ __("Mailbox") }}
    
  </a>

</div>
