@extends('layouts.app')

@php
  
  use App\Helper\Enumeration\Searchbox;
  use App\Helper\Enumeration\Mailbox;
  use Illuminate\Support\Facades\Route;

@endphp

@section('head')

  @yield('head-final')

  <title>{{ __("Mail") }} | {{ config('app.name') }}</title>

@endsection

@section('content')

  <div class="flexbox">
    <header class="single flexbox">
      <div class="octal-fill flexbox flexbox-vertical flexbox-horizontal">
        <a href="{{ route('home', []) }}">
          <img  class="icon-holder-128"
                src="{{ $logo }}"
                alt="logo, open book, ereg text in the middle" />

        </a>

      </div>
      
      <div class="octal-fill flexbox flexbox-vertical flexbox-horizontal">

        <div class="single">

          @if ($mailCategory == Mailbox::None)
          
            <div class="mb-1 text-center">
              <span class="font-info">{{ __('Default: Inbox') }}</span>

            </div>
          
          @endif

          @include ('Snippet/searchbox', [
            'route' => route('mail.index', ['mailbox' => $mailCategory]),
            'search' => $search ?? ''
          ])

        </div>

      </div>
      
      <div class="octal-fill flexbox flexbox-vertical flexbox-horizontal">

        @include('Snippet/header-profile')

      </div>

    </header>

    <nav class="hex-fill w-max-256">

      {{-- NAVIGATION --}}

      <!-- compose -->
      <a  class="button button-route b-1 curvy-round mb-1 w-100
                @if (Route::currentRouteName() == 'mail.create') active @endif"
          href="{{ route('mail.create') }}">
          + {{ __("Compose") }}
        
      </a> <!-- /compose -->

      <!-- inbox -->
      <a  class="button button-route b-1 curvy-04 mb-1 w-100
                @if ($mailCategory == Mailbox::Inbox) active @endif"
          href="{{ route('mail.index', ['mailbox' => Mailbox::Inbox->value]) }}">
          {{ __("Inbox") }}
        
      </a> <!-- /received -->

      <!-- sent -->
      <a  class="button button-route b-1 curvy-04 w-100
                @if ($mailCategory == Mailbox::Sent) active @endif"
          href="{{ route('mail.index', ['mailbox' => Mailbox::Sent->value]) }}">
          {{ __("Sent") }}
        
      </a> <!-- /sent -->

    </nav>

    <main class="binary-fill">

      @yield('content-final')
      
    </main>

  </div>

@endsection