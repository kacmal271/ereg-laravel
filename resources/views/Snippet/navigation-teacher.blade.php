<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * This File - Goals
 * # declare markup -> Basic Routes -> Person:Teacher
 */

?>

<div class="single p-0 navigation-vertical">

  <!-- NOT FLEXBOX -->
  <!-- NOT FLEX ITEMS -->

  {{-- SELECT ACTIVE PAGE --}}

  <?php

  use App\Helper\Enumeration\Students;
  use App\Helper\Enumeration\SchoolFeature;
  use App\Helper\Enumeration\Mailbox;
  use App\Helper\Enumeration\TimePeriod;
  use Illuminate\Support\Facades\Route;

  $activeIndex = null;
  
  switch (Route::currentRouteName())
  {
    // (MY) DATA

    case 'nonattendance.create.date.time' :
    case 'nonattendance.create.date' :
    case 'nonattendance.create' :

      $activeIndex = 1;

      break;

  }

  ?>

  <!-- default: (CREATE) NONATTENDANCE -->

  <a  class="button button-route navigation-vertical-element bt-1 bb-1
             @if ($activeIndex == 1) active @endif"
      href="{{ route('nonattendance.create', ['timePeriod' => TimePeriod::None->value]) }}">
      {{ __("Edit Attendance") }}
    
  </a>

  <!-- (MY) DATA -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'user.show') active @endif"
      href="{{ route('user.show', ['id' => auth()->user()->id ]) }}">
      {{ __("My Data") }}
    
  </a>

  <!-- (CREATE) GRADE -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'grades.create') active @endif"
      href="{{ route('grades.create', [
        'schoolFeature'   => SchoolFeature::None->value,
        'group'           => 0,
        'subject'         => 0
      ]) }}">
      {{ __("Add Grade") }}
    
  </a>

  <!-- (CREATE) PRAISE -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'praise.create') active @endif"
      href="{{ route('praise.create', [
        'students'  => Students::School->value,
        {{--
          laravel router doesnt like nulls
          empty string converted to null
          by -> 'web': middleware group
        --}} 
        'groupId'    => 0  {{-- cannot: null --}},
        {{--
          laravel router doesnt like nulls
          empty string converted to null
          by -> 'web': middleware group
        --}} 
        'userId'    => 0  {{-- cannot: null --}}
      ]) }}">
      {{ __("Send Praise or Notice") }}
    
  </a>

  <!-- (CREATE) MEETING -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'meeting.create') active @endif"
      href="{{ route('meeting.create') }}">
      {{ __('Appoint Meeting') }}
    
  </a>

  <!-- (MY) MEETINGS -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'meeting.index') active @endif"
      href="{{ route('meeting.index', ['id' => auth()->user()->id]) }}">
      {{ __("Meetings") }}
    
  </a>

  <!-- MAIL -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'mail.index') active @endif"
      href="{{ route('mail.index', ['mailbox' => Mailbox::Inbox->value]) }}">
      {{ __("Mailbox") }}
    
  </a>

</div>
