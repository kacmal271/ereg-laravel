@extends('layouts.welcome-user')

@section('content-final')

  @if ($feature == \App\Helper\Enumeration\SchoolFeature::None)

    {{-- DISPLAY GROUPS TO CLICK ON --}}

    <div class="single">

      @foreach ($groups as $group)
        <div class="p-0 text-center ma mb-1">
          <a class="button button-route curvy-0"
              href="{{ url($links[$loop->index]) }}">
            {{ $group->name }}
          
          </a>

        </div>

      @endforeach

    </div>
  
  @elseif ($feature == \App\Helper\Enumeration\SchoolFeature::Group)

    {{-- DISPLAY GROUP'S SCHEDULE TO MODIFY --}}

    <div class="single flexbox flexbox-horizontal-left flexbox-vertical-top">

      @foreach ($weekSchedule as $day => $daySchedule)

        <!-- day -->
        <div class="octal flexbox p-0">
          <!-- day name -->
          <div class="single">
            <h5>{{ __(ucfirst($day)) }}</h5>
          
          </div> <!-- /day name -->

          <livewire:schedule.schedule-form :daySchedule="$daySchedule"
                                            :weekDay="$day"
                                            :group="$group"
                                            :teachers="$teachers"
                                            :subjects="$subjects"
                                            :key="$loop->index" />

        </div> <!-- /day -->

      @endforeach

    </div>

  @endif

@endsection