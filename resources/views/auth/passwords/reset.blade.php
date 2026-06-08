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
    <form action="{{ route('auth.password.reset') }}"
          method="post"
          class="single flexbox">
      
      @csrf

      {{-- PASSWORD RESET MUST ENSUE FROM EMAIL
            EMAIL CONTAINS TOKEN
      --}}
      <input name="token" value="{{ $token }}" type="hidden" /> {{-- 1of4: MANDATORY: name=email --}}

      <!-- email -->

      <div class="single">
        <div class="mb-1 pl-1">
          <label for="email"
                  class="pointer font-s">
            {{ __('Confirm E-mail') }}
        
          </label>

        </div>

        <div class="mb-1">
          <input name="email"                                   {{-- 2of4: MANDATORY: name=email --}}
                  class="highlight w-100"
                  tabindex="1"
                  id="email"
                  value="{{ old('email') }}"
                  autocomplete="off" />

        </div>

        @error('email')

          <div class="pl-1">
            <span class="font-error">{{ $message }}</span>

          </div>
              
        @enderror

      </div> <!-- /email -->

      <!-- password -->

      <div class="single">
        <div class="mb-1 pl-1">
          <label for="password"
                  class="pointer font-s">
            {{ __('Password') }}
          
          </label>

        </div>

        <div class="mb-1">
          <input name="password"                                {{-- 3of4: MANDATORY: name=password --}}
                  class="w-100"
                  tabindex="2"
                  id="password"
                  type="password"
                  autocomplete="off" />

        </div>

        @error('password')

          <div class="pl-1">
            <span class="font-error">{{ $message }}</span>

          </div>
              
        @enderror

      </div> <!-- /password -->

      <!-- password_confirmation -->

      <div class="single">
        <div class="mb-1 pl-1">
          <label for="password_confirmation"
                  class="pointer font-s">
            {{ __('Confirm Password') }}
        
          </label>

        </div>

        <div class="mb-1">
          <input  name="password_confirmation"                  {{-- 4of4: MANDATORY: name=password --}}
                  class="w-100"
                  tabindex="3"
                  id="password_confirmation"
                  type="password"
                  autocomplete="off" />

        </div>

        @error('password_confirmation')

          <div class="pl-1">
            <span class="font-error">{{ $message }}</span>

          </div>
              
        @enderror

      </div> <!-- /password_confirmation -->

      <!-- reset -->

      <div class="single flexbox flexbox-horizontal-right">
        <button   class="button button-submit w-100"
                  tabindex="10">
          {{ __("Reset") }}

        </button>

      </div> <!-- /reset -->
    
    </form>

  </main>

</div>

@endsection
