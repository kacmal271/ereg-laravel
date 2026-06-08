@extends('layouts.welcome-user')

@section('selectbar')

    @include('Snippet.selectbar-parent-child-picker')

@endsection

@section('content-final')

  {{-- DISPLAY GROUP'S SCHEDULE TO MODIFY --}}

  <div class="single flexbox flexbox-horizontal-left flexbox-vertical-top">

    @foreach ($weekSchedule as $day => $daySchedule)

      <!-- day -->
      <div class="octal flexbox p-0">
        <!-- day name -->
        <div class="single">
          <h5>{{ __(ucfirst($day)) }}</h5>
        
        </div> <!-- /day name -->

        <!-- day-schedule -->
        <div class="single flexbox">

          {{-- SCHEDULE --}}
          {{-- SCHEDULE --}}
          {{-- SCHEDULE --}}

          @if (empty($daySchedule))

            <div class="single text-center nowrap">
              <span>{{ __('N/A') }}</span>
            
            </div>
          
          @else

            <!-- lessons-padding -->
            <table class="single b-0">

              @foreach ($daySchedule as $index => $lesson)
                {{-- $daySchedule:
                      sorted array
                      didnt preserve int-key order (0, 9, 1, ..)
                --}}

                <!-- lesson -->
                  <tr class="b-1 text-left">
                    <!-- lesson: hours -->
                    <td class="b-0">
                      <span class="reset-style font-time block">
                        {{ $daySchedule[$index]['start'] }}

                      </span>

                      <span class="reset-style font-time-alt  block">
                        {{ $daySchedule[$index]['end'] }}
                        
                      </span>

                    </td> <!-- /lesson: hours -->

                    <!-- lesson: subject + teacher -->
                    <td class="b-0">
                      <span class="reset-style font-text block nowrap">
                        {{ $daySchedule[$index]['subject'] }}

                      </span>

                      <span class="reset-style font-text-alt block nowrap">
                        {{ $daySchedule[$index]['teacher'] }}
                        
                      </span>

                    </td> <!-- /lesson: subject + teacher -->

                  </tr> <!-- /lesson -->

              @endforeach

            </table> <!-- /lessons-padding -->

          @endif

        </div> <!-- /day-schedule -->

      </div> <!-- /day -->

    @endforeach

  </div>

@endsection