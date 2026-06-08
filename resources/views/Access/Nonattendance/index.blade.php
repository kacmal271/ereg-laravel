@extends('layouts.welcome-user')

@section('head-final')

	<title>{{ __("Nonattendance") }} | {{ config('app.name') }}</title>

@endsection

@section('selectbar')

  @include('Snippet.selectbar-parent-child-picker')

@endsection

@section('content-final')

  <div class="single">

    <table class="responsive nowrap ma b-0">

      @foreach ($nonattendancesCalendar as $year => $months)

        <!-- year -->
        <tr class="b-0">

          {{-- (A) # of attributes --}}
          <td>

            <div class="mt-4 text-center">

              <h5>{{ $year }}</h5>

            </div>

          </td>

        </tr> <!-- /year -->

        @foreach ($months as $month => $nonattendances)

          <!-- month -->
          <tr class="b-0">

            {{-- (A) # of attributes --}}
            <td>

              <div class="mb-1 mt-1">

                <h6 class="text-left">{{ __($month) }}</h6>

              </div>

            </td>

          </tr> <!-- /month -->

          @foreach ($nonattendances as $nonattendance)

            @if ($loop->first)

              <tr class="b-0 b-2">

                {{-- (A) # of attributes --}}
                <th class="b-0">{{ __('Day') }}</th>
                <th class="b-0 bl-2">{{ __('Hour') }}</th>
                <th class="b-0 bl-2">{{ __('Subject') }}</th>
                <th class="b-0 bl-2">{{ __('Is Excused?') }}</th>

              </tr>

            @endif

            <!-- nonattendances -->
            <tr class="b-0 br-2 bb-2 bl-2 @if ( ! $nonattendance->isExcused) background-warning font-black @endif">

              <td class="b-0 text-left">
                {{ $nonattendance->nonattendanceWhen->format('d') }}
                {{ __(ucfirst($nonattendance->schedule->dayName)) }}
              </td>
              <td class="b-0 bl-2">{{ $nonattendance->schedule->startTime->format('H:i') }}</td>
              <td class="b-0 bl-2">{{ $nonattendance->schedule->lesson->subject->abbreviation }}</td>
              <td class="b-0 bl-2">{{ $nonattendance->isExcused ? __('Excused') : __('Not Excused') }}</td>
            
            </tr> <!-- /nonattendances -->
          
          @endforeach {{-- nonattendances --}}

        @endforeach {{-- month --}}

      @endforeach {{-- year --}}

    </table>

    @empty ($nonattendancesCalendar)

      <div class="text-center">

        <span class="font-l font-green">

          @if (auth()->user()->role->name == config('role.student.name'))

              {{ __('Congratulations!') }}

          @endif

          {{ __('No Nonattendance on record.') }}

        </span>

      </div>

    @endempty

  </div>

@endsection