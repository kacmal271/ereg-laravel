@extends('layouts.welcome-user')

@section('head-final')

	<title>{{ __("Add Assessment") }} | {{ config('app.name') }}</title>

@endsection

@section('content-final')

  <!-- wrapper -->
  <div class="single flexbox">

    <!-- input -->
    <div class="binary flexbox flexbox-horizontal">

      <form method="post"
            action="{{ route('assessment.store') }}">

        @csrf

        @method('put')

        <!-- assessment-name-wrapper -->
        <div class="mb-1">

          <!-- assessment-name -->
          <div class="ma w-max-256">

            <div class="single p-0 mb-04 pl-1">
            
              <label for="assessmentName" class="pointer font-s">{{ __('Assessment Name') }}</label>

            </div>

            <div class="single p-0">

              {{-- VULNERABILITY PREVENTION --}}
              {{-- dont name input like in database --}}
              <input  id="assessmentName"
                      name="assessmentName"
                      autocomplete="off"
                      value="{{ old('assessmentName') }}"
                      class="w-100"
                      required />

            </div>

            @error('assessmentName')

              <div class="single p-0">
                <span class="font-error nowrap">{{ $message }}</span>

              </div>
                
            @enderror

          </div> <!-- /assessment-name -->

        </div> <!-- /assessment-name-wrapper -->

        <!-- assessment-value-wrapper -->
        <div>

          <!-- assessment-value -->
          <div class="ma w-max-256">

            <div class="single p-0 mb-04 pl-1">
            
              <label for="assessmentValue" class="pointer font-s">
                <span class="block nowrap">{{ __('Assessment Value') }}</span>
                <span class="block nowrap">&#x28;{{ __('Natural Number') }}&#x29;</span>
              </label>

            </div>

            <div class="single p-0">

              {{-- VULNERABILITY PREVENTION --}}
              {{-- dont name input like in database --}}
              <input  min="0"
                      step="1"
                      type="number"
                      id="assessmentValue"
                      name="assessmentValue"
                      autocomplete="off"
                      value="{{ old('assessmentValue') }}"
                      class="w-100"
                      required />

            </div>

            @error('assessmentValue')

              <div class="single p-0">
                <span class="font-error nowrap">{{ $message }}</span>

              </div>
                
            @enderror

          </div> <!-- /assessment-value -->

        </div> <!-- /assessment-value-wrapper -->

        <!-- submit -->
        <div class="mt-1">

          <div class="ma w-max-256">

            <button class="button button-submit w-min-256">{{ __('Save') }}</button>

          </div>

        </div> <!-- /submit -->

      </form>

    </div> <!-- /input -->

    <!-- output -->
    <div class="binary">

      <!-- table -->
      <table>

        <tr>
          <th colspan="2">{{ __('Grades') }}</th>
        </tr>

        <tr>

        <tr>
          <th>{{ __('Type') }}</th>
          <th>{{ __('Value') }}</th>
        </tr>

        @foreach ($assessments as $assessment)

          <tr class="text-center">
            <td>{{ $assessment->name }}</td>
            <td>{{ $assessment->value }}</td>
          </tr>

        @endforeach

      </table> <!-- /table -->

    </div> <!-- /output -->

  </div> <!-- /wrapper -->

@endsection

