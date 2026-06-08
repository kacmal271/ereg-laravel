@extends('layouts.welcome-user')

@section('head-final')

	<title>{{ __("Notification") }} | {{ config('app.name') }}</title>

@endsection

@section('content-final')

  <div class="single">
    <form method="post"
          action="{{ route('notification.store') }}">
      @csrf

      {{-- TITLE --}}

      <div class="single flexbox">
        <div class="quart text-left flexbox flexbox-vertical flexbox-horizontal">
          <label  for="notificationTitle"
                  class="pointer font-l">{{ __("Title") }}</label>

        </div>

        <div class="binary-fill">
          {{-- VULNERABILITY PREVENTION --}}
          {{-- dont name input like in database --}}
          <input  name="notificationTitle"
                  class="highlight @error('notificationTitle') error @enderror w-100"
                  id="notificationTitle"
                  type="text"
                  value="{{old('notificationTitle')}}"
                  required />

        </div>

      </div>

      @error('notificationTitle')
        <div class="single flexbox">
          <div class="quart">

          </div>

          <div class="binary-fill">
              <span class="font-error">{{ $message }}</span>

          </div>

        </div>
          
      @enderror

      {{-- NOTIFICATION --}}

      <div class="single flexbox">
        <div class="quart text-left flexbox flexbox-horizontal">
          <label  for="notificationMessage"
                  class="pointer font-l">{{ __('Notification') }}</label>

        </div>

        <div class="binary-fill">
          {{-- VULNERABILITY PREVENTION --}}
          {{-- dont name input like in database --}}
          <textarea name="notificationMessage"
                    class="@error('notificationMessage') error @enderror w-100"
                    id="notificationMessage"
                    type="text"
                    value="{{old('notificationMessage')}}"
                    required></textarea>

        </div>

      </div>

      @error('notificationMessage')
        <div class="single flexbox">
          <div class="quart">

          </div>

          <div class="binary-fill">
              <span class="font-error">{{ $message }}</span>

          </div>

        </div>
          
      @enderror

      {{-- EXPIRES --}}

      <div class="single flexbox">
        <div class="quart text-center">
          <label  for="notificationExpires"
                  class="pointer font-l">{{ __('Expires on') }}</label>

          <span class="block font-info">{{ lcfirst(__('Is invisible by then')) }}</span>

        </div>

        <div class="binary-fill">
          {{-- VULNERABILITY PREVENTION --}}
          {{-- dont name input like in database --}}
          <input  name="notificationExpires"
                  class="@error('notificationExpires') error @enderror w-100"
                  id="notificationExpires"
                  type="date"
                  value="{{old('notificationExpires')}}"
                  required>

        </div>

      </div>

      {{-- SUBMIT --}}

      <div class="single flexbox">
        <button class="button button-submit w-100">{{ __('Save') }}</button>

      </div>
          

    </form>

  </div> <!-- FORM WRAPPER -->

@endsection