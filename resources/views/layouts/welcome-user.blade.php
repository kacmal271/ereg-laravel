@extends('layouts.app')

@section('head')

  @yield('head-final')

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
        <h4>{{ __("Welcome") }}, {{ auth()->user()->fname }}!</h4>

      </div>
      
      <div class="octal-fill flexbox flexbox-vertical flexbox-horizontal">
      
        @include('Snippet/header-profile')

      </div>

    </header>

    <section class="single flexbox flexbox-horizontal-space">

      <div class="single flexbox">

        @include('Snippet/notifications')

      </div>

      @yield('selectbar')

    </section>

    <nav class="hex-fill flexbox p-0">

      {{-- NAVIGATION --}}

      <?php $roleName = auth()->user()->role->name; ?>

      @if ($roleName == config('role.parent.name'))
        @include('Snippet/navigation-parent')

      @elseif ($roleName == config('role.student.name'))
        @include('Snippet/navigation-student')

      @elseif ($roleName == config('role.admin.name'))
        @include('Snippet/navigation-admin')

      @elseif ($roleName == config('role.teacher.name'))
        @include('Snippet/navigation-teacher')

      @endif

    </nav>

    <main class="binary-fill flexbox">
    
      @yield('content-final')
      
    </main>

    @if (auth()->user()->role->code == config('role.student.code'))
 
      <footer class="single">

        <x-multiplication-table-game />

      </footer


    @endif

  </div>

@endsection