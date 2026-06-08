@extends('layouts.welcome-user')

@section('head-final')

  <title>{{ __('Grades') }} | {{ config('app.name') }}</title>

@endsection

@section('selectbar')

  @include('Snippet.selectbar-parent-child-picker')

  {{-- PARENT AND STUDENT --}}

  <div class="binary flexbox flexbox-horizontal navigation-inline">

    {{-- GRADES --}}

    <div class="pr-1 navigation-element">
      <a class="button button-route @if ($isStatistics == 0) active @endif"
          href="{{ route('grades.index', ['id' => $user->id, 'isStatistics' => 0])}}">
        {{ __("Grades") }}

      </a>

    </div> <!-- nagivation oceny -->

    {{-- STATISTICS --}}

    <div class="pr-1 navigation-element">
      <a class="button button-route @if ($isStatistics == 1) active @endif"
          href="{{ route('grades.index', ['id' => $user->id, 'isStatistics' => 1])}}">
        {{ __("Statistics") }}

      </a>

    </div> <!-- nagivation statystyka -->

  </div>

@endsection

@section('content-final')

  <!-- page-wrapper -->
	<div class="binary-fill text-center p-0">

    <!-- grades-wrapper -->
    <div class="inline-block text-left">

      @if (empty($subjects))

        {{-- subjects-empty --}}

        <span class="block font-l text-center">{{ __("No Subjects assigned yet") }}</span>
        <span class="block font-l text-center">{{ lcfirst(__("Please ask at your school")) }}</span>

      @else

        {{-- subjects-exist --}}

        @if ( ! $isStatistics)

          <table class="highlight">

            <!-- grades-header -->
            <tr>
              <th>{{ __("Subject") }}</th>
              <th>{{ __("Grade") }} ({{ __("Weight") }})</th>
              <th>{{ __("Mean") }}</th>

            </tr> <!-- /grades-header -->

            @for ($indexOfSubject = 0; $indexOfSubject < count($subjects); $indexOfSubject++)

              {{-- THIS USER'S SUBJECT --}}

              <tr>

                <td>{{ $subjects[$indexOfSubject] }}</td>
                <td>

                  @for ($indexOfGrade = 0; $indexOfGrade < count($grades[$indexOfSubject]); $indexOfGrade++)

                    {{-- THIS USER'S SUBJECT'S GRADE --}}

                    <span>{{ $grades[$indexOfSubject][$indexOfGrade] }}</span>

                    <span> ({{ $weights[$indexOfSubject][$indexOfGrade] }})</span>

                    @if ($indexOfGrade < count($grades[$indexOfSubject]) - 1)
                    
                      <span>, </span>
                    
                    @endif
                  
                  @endfor

                </td>

                <td>{{ $meansWeightedFormatted[$indexOfSubject] }}</td>

              </tr>

            @endfor

          </table>
        
        @else

          <div class="highlight">

            @include('Snippet.grades-barchart')
          
          </div>
        
        @endif

      @endif

    </div> <!-- /grades-wrapper -->

  </div> <!-- /page-wrapper -->

@endsection