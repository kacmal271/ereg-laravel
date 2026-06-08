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
    case 'user.edit' :
      if ($user->id == auth()->user()->id)
        // My Data
        $activeIndex = 2;
      else
        // My Child Data (for Parent)
        $activeIndex = 3;
      break;

  }

  ?>

  <!-- default: (My) GRADE -->

  <a  class="button button-route navigation-vertical-element bt-1 bb-1
             @if (Route::currentRouteName() == 'grades.index') active @endif"
      href="{{ route('grades.index', [
        'id' => auth()->user()->ChildId(),
        'isStatistics' => ($isStatistics ?? 0)]) }}">
      {{ __("Grades") }}
    
  </a>

  <!-- My Data -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if ($activeIndex == 2) active @endif"
      href="{{ route('user.show', ['id' => auth()->user()->id]) }}">
      {{ __("My Data") }}
    
  </a>

  <!-- My Child Data (for Parent) -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if ($activeIndex == 3) active @endif"
      href="{{ route('user.show', ['id' => auth()->user()->ChildId()]) }}">
      {{ __("Student Data") }}
    
  </a>

  <!-- SCHEDULE -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'schedule.index') active @endif"
      href="{{ route('schedule.index', ['id' => auth()->user()->ChildId()]) }}">
      {{ __("Schedule") }}
    
  </a>

  <!-- (MY) NONATTENDANCE -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'nonattendance.index') active @endif"
      href="{{ route('nonattendance.index', ['id' => auth()->user()->ChildId()]) }}">
      {{ __("Nonattendance") }}
    
  </a>

  <!-- PRAISES AND NOTICES -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'praise.index') active @endif"
      href="{{ route('praise.index', ['id' => auth()->user()->ChildId()]) }}">
      {{ __("Praises and Notices") }}
    
  </a>

  <!-- (MY) MEETINGS -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'meeting.index') active @endif"
      href="{{ route('meeting.index', ['id' => auth()->user()->ChildId()]) }}">
      {{ __("Meetings") }}
    
  </a>

  <!-- MAIL -->

  <a  class="button button-route navigation-vertical-element bb-1
             @if (Route::currentRouteName() == 'mail.index') active @endif"
      href="{{ route('mail.index', ['mailbox' => Mailbox::Inbox->value]) }}">
      {{ __("Mailbox") }}
    
  </a>

</div>
