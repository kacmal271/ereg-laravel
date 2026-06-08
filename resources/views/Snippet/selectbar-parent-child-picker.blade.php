{{-- COPY PASTE WHERE PARENT HAS CHOICE OF CHILDREN --}}

{{-- FILE UPDATED MANUALLY --}}

{{--  $user determines chosen child
      $routeVariables determines route variables payload
--}}

{{-- CONTROLLER --}}
{{-- CONTROLLER --}}
{{-- CONTROLLER --}}

<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

// assert: $user is always valid User Model
// assert: $user is always chosen
if (! isset($user))
  $user = User::FindOrFail(auth()->user()->ChildId());

// assert: auth-user is parent
if (auth()->user()->role->name != config('role.parent.name'))
  return;

// assert: parent doesnt check himself
if ($user->id == auth()->user()->id)
  return;

if ($user->role->name == config('role.student.name'))
// PARENT Set current child (hold this information between views)
  auth()->user()->ChildId($user->id);

$routeVariables = [];

foreach(auth()->user()->children as $child)
{
  // Children Data should be fit ...

  switch (Route::currentRouteName())
  {
    // ... into appropriate route variables

    // so that Order can prevail over Chaos !

    // (My) GRADE (Parent checks Child)

    case 'grades.index' :

      $routeVariables[] = [
        'id' => $child->id,
        'isStatistics' => $isStatistics
      ];

      break;

    // (MY) MEETINGS (Parent checks Child)

    case 'meeting.index' :

    // (MY) DATA (Parent checks Child)

    case 'user.show' :

    // SCHEDULE (Parent checks Child)

    case 'schedule.index' :

    // (MY) NONATTENDANCE (Parent checks Child)

    case 'nonattendance.index' :

    // PRAISES AND NOTICES (Parent checks Child)

    case 'praise.index' :

      $routeVariables[] = [
        'id' => $child->id
      ];
      
      break;

  }

}

?>

{{-- VIEW --}}
{{-- VIEW --}}
{{-- VIEW --}}

<!-- PARENT ONLY -->

<div class="binary flexbox flexbox-horizontal flexbox-vertical">

  <span class="pr-1">{{ __("I want to check") }}</span>

  {{-- Custom SELECT Option --}}

  <div class="popup-parent text-center" tabindex="0">

    {{-- Custom Select Option COLLAPSED --}}

    <div class="popup-thumbnail">
      <span class="button reset-style active">
        {{ $user->fname }} {{ $user->lname }}
        
      </span>

    </div>

    <div class="popup-child popup-child-auto popup-child-bottom-right">

      {{-- Custom Select Option BACKGROUND --}}

      <div class="popup-child-background curvy-1"></div>

      @foreach (auth()->user()->children as $child)

        {{-- Custom Select OPTION # of N --}}

        <div class="@if(! $loop->first) bt-1 @endif">

            <a class="button {{ $user->id == $child->id ? 'active' : '' }}"

                  {{-- routeVariables OF THE CURRENT CHILD --}}
                href="{{ route(Route::currentRouteName(), $routeVariables[$loop->index])}}"
                
                >

              {{ $child->fname }} {{ $child->lname }}

            </a>

        </div> <!-- One Select OPTION -->

      @endforeach <!-- Display all Select OPTION -->

    </div> <!-- Display all Select OPTION -->

  </div> <!-- popup-parent -->

</div> <!-- / PARENT ONLY -->