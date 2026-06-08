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
    <form action="{{ route('auth.password.sendResetEmail') }}"
          method="post"
          class="single flexbox">
      @csrf

      <!-- email -->

      <div class="single">
        <div class="mb-1 pl-1">
          <label  for="email"
                  class="pointer font-s">
            {{ __('E-mail') }}
          
          </label>

        </div>

        <div class="mb-1">
          <input name="email"              {{-- MANDATORY: name=email --}}
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

      <!-- reset -->

      <div class="single flexbox flexbox-horizontal-right mt-1">
        <button   class="button button-submit w-100"
                  tabindex="10">
          {{ __("Send Me E-Mail") }}

        </button>

      </div> <!-- /reset -->
    
    </form>

  </main>

  @if (session()->has('status'))

    @include('Snippet.statusbar', [
      'status' => 'status.ok',
      'statusbarMessage' => session('status')
    ])

  @endisset

</div>

@endsection
