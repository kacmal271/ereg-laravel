@extends('layouts.welcome-user')

@section('head-final')

	<title>{{ __("Add Class") }} | {{ config('app.name') }}</title>

@endsection

@section('content-final')

  {{-- result --}}

  @if (session()->has('status'))

    @include('Snippet.statusbar', [
      'status' => session('status'),
      'statusbarMessage' => session('statusbarMessage')
    ])

  @endif

  {{-- /result --}}

  <form method="post"
        action="{{ route('group.store') }}"
        class="w-100">

    @csrf

    @method('put')

    <!-- class-name-wrapper -->
    <div>

      <!-- class-name -->
      <div class="ma w-max-256">

        <div class="single p-0 mb-04 pl-1">
        
          <label for="className" class="pointer font-s">{{ __('Class Name') }}</label>

        </div>

        <div class="single p-0">

          {{-- VULNERABILITY PREVENTION --}}
          {{-- dont name input like in database --}}
          <input  id="className"
                  name="className"
                  autocomplete="off"
                  value="{{ old('className') }}"
                  class="w-100"
                  required />

        </div>

        @error('className')

          <div class="single p-0">
            <span class="font-error nowrap">{{ $message }}</span>

          </div>
            
        @enderror

      </div> <!-- /class-name -->

    </div> <!-- /class-name-wrapper -->

    <!-- submit -->
    <div class="mt-1">

      <div class="ma w-max-256">

        <button class="button button-submit w-min-256">{{ __('Save') }}</button>

      </div>

    </div> <!-- /submit -->

  </form>

@endsection

