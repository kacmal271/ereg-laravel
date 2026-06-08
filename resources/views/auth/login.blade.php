@extends('layouts.app')

@section('content')
<div class="container w-max-512">
  <header class="single flexbox flexbox-horizontal flexbox-vertical">
    <a href="{{ route('auth.index') }}">
      <img  class="icon-holder-128"
            src="{{url('/svg/logo-ereg.svg')}}"
            alt="logo" />
    
    </a>

  </header>

  <main class="single flexbox flexbox-horizontal">
    <form action="{{ route('auth.show') }}"
          method="post"
          class="single flexbox">
          
      @csrf

      {{-- LOGIN: ID --}}

      <div class="single">
        <div class="mb-1 pl-1">
          <label for="id"
                  class="pointer font-s">
            ID
          
          </label>

        </div>

        <div class="mb-1">
          <input name="id"
                  class="highlight w-100"
                  tabindex="1"
                  id="id"
                  value="{{ old('id') }}"
                  autocomplete="off" />

        </div>

        @error('id')

          <div class="pl-1">
            <span class="font-error">{{ $message }}</span>

          </div>
              
        @enderror

      </div>

      {{-- PASSWD --}}

      <div class="single">
        <div class="mb-1 pl-1">
          <label for="password"
                  class="pointer font-s">
            {{ __("Password") }}
          
          </label>

        </div>

        <div class="mb-1">
          <input name="password"
                  class="w-100"
                  tabindex="2"
                  id="password"
                  type="password" />

        </div>

        @error('password')

          <div class="pl-1">
            <span class="font-error">{{ $message }}</span>

          </div>
            
        @enderror

      </div>

      <div class="single flexbox flexbox-horizontal-space">

        {{-- REMEMBER ME --}}

        <div>

          {{-- CHECKBOX --}}

          <td class="pl-1 b-0">
            <label class="checkbox">
              <div class="checkbox-positioner">
                <input  name="remember"
                        id="remember"
                        type="checkbox"
                        tabindex="10" />
                
                <div class="checkbox-container"></div>

              </div>

              <span class="checkbox-text">{{ __('Remember me') }}</span>

            </label>

          </td>

        </div>

        {{-- RESET PASSWORD --}}

        <div>
          <a href="{{ route('auth.password.index') }}"
              tabindex="11">
            {{ __("I forgot my password!") }}

          </a>

        </div>

      </div>

      {{-- LOGIN BUTTON --}}

      <div class="single flexbox flexbox-horizontal-right">
        <button   class="button button-submit w-100"
                  tabindex="20">
          {{ __("Log in") }}

        </button>

      </div>
    
    </form>

  </main>

  @error('failed')

    <!-- failed -->

    @include('Snippet.statusbar', [
      'status' => 'status.error',
      'statusbarMessage' => $message
    ])
    
    <!-- / failed -->

  @enderror

</div>

@endsection
