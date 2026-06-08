@extends('layouts.welcome-user')

@section('head-final')

	<title>{{ __('Add Subject') }} | {{ config('app.name') }}</title>

@endsection

@section('content-final')

  <div class="w-max-512 ma">

    <form action="{{ route('subject.store') }}"
          method="post">
          
      @csrf

      @method('put')

      <!-- full-name -->
      <div class="mb-1">

        <div class="mb-04 pl-1">

          <label  for="fullName"
                  class="pointer font-s">{{ __('Full Name.object') }}</label>

        </div>

        <div class="mb-04">

          <input  name="fullName"
                  class="text-center highlight w-100"
                  id="fullName"
                  value="{{ old('fullName') }}" />
          
          <span class="text-center block font-info">{{ lcfirst(__('E.g. "English"')) }}</span>

        </div>

        @error('fullName')

          <div class="pl-1">

            <span class="font-error">{{ $message }}</span>

          </div>
              
        @enderror

      </div> <!-- /full-name -->

      <!-- short-name -->
      <div class="mb-1">

        <div class="mb-04 pl-1">

          <label  for="shortName"
                  class="pointer font-s">{{ __("Abbreviated Name") }}</label>

        </div>

        <div class="mb-04">

          <input  name="shortName"
                  class="text-center w-100"
                  id="shortName"
                  value="{{ old('shortName') }}" />
          
          <span class="text-center block font-info">{{ lcfirst(__('E.g. "eng."')) }}</span>

        </div>

          @error('shortName')

            <div class="pl-1">

              <span class="font-error">{{ $message }}</span>

            </div>
              
          @enderror

      </div> <!-- /short-name -->

      <!-- save-button -->
      <div>

        <button class="button button-submit w-100">{{ __("Save") }}</button>

      </div> <!-- /save-button -->
    
    </form>

  </div>

  @if(session()->has('status'))

    <!-- statusbar -->

    @include('Snippet.statusbar', [
      'status' => session('status', ''),
      'statusbarMessage' => session('statusbarMessage', '')
    ])
    
    <!-- /statusbar -->

  @endif

@endsection