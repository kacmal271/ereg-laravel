<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * This File - Goals
 * # declare markup -> Basic Routes -> Person:Admin
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

  $activeIndex = null;
  
  switch (Route::currentRouteName())
  {
    // (MY) DATA

    case 'user.show' :

      // if admin checks user
      if (auth()->user()->id == $user->id)
      {
        // if user checks themself
        $activeIndex = 1;
      }
      break;

    // (EDIT) SCHEDULE

    case 'schedule.create.group' :
    case 'schedule.create' :

      $activeIndex = 7;
      break;

  }
  
  ?>

  <!-- default: (CREATE) NOTIFICATION -->

  <a  class="button button-route navigation-vertical-element bt-1 bb-1
             @if (Route::currentRouteName() == 'notification.create') active @endif"
      href="{{ route('notification.create') }}">
      {{ __("Create Notification") }}
    
  </a>

  <!-- (MY) DATA -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if ($activeIndex == 1) active @endif"
      href="{{ route('user.show', ['id' => auth()->user()->id]) }}">
      {{ __("My Data") }}
    
  </a>

  <!-- (CREATE) GROUP -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'group.create') active @endif"
      href="{{ route('group.create') }}">
      {{ __("Create Group") }}
    
  </a>

  <!-- (USER) INDEX -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'user.index') active @endif"
      href="{{ route('user.index', ['code' => config('role.null.code')]) }}">
      {{ __("List Accounts") }}
    
  </a>

  <!-- (CREATE) SUBJECT -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'subject.create') active @endif"
      href="{{ route('subject.create') }}">
      {{ __("Create Subject") }}
    
  </a>

  <!-- (CREATE) ASSESSMENT -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'assessment.create') active @endif"
      href="{{ route('assessment.create') }}">
      {{ __("Create Assessment") }}
    
  </a>

  <!-- (EDIT) SCHEDULE -->

  @php $routeArgument = App\Helper\Enumeration\SchoolFeature::None->value; @endphp

  <a  class="button button-route navigation-vertical-element bb-1
             @if ($activeIndex == 7) active @endif"
      href="{{ route('schedule.create', [$routeArgument]) }}">
      {{ __("Edit Schedule") }}
    
  </a>

  <!-- MAIL -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'mail.index') active @endif"
      href="{{ route('mail.index', ['mailbox' => Mailbox::Inbox->value]) }}">
      {{ __("Mailbox") }}
    
  </a>

  <!-- (EDIT) SCHOOL -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'school.edit') active @endif"
      href="{{ route('school.edit') }}">
      {{ __("Edit School Data") }}
    
  </a>

</div>
