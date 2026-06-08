@extends('layouts.welcome-user')

@section('head-final')

	<title>{{ __('Add Grade') }} | {{ config('app.name') }}</title>

@endsection

@section('content-final')

  <div class="single">

    @if ($feature == \App\Helper\Enumeration\SchoolFeature::None)

      {{-- DISPLAY GROUPS TO PICK FROM --}}

      @foreach ($links as $link)

        <div class="mb-04 text-center">
          <a class="button button-route curvy-0"
              href="{{ url($link) }}">
            {{ $groups[$loop->index]->name }}
          
          </a>

        </div>

      @endforeach

    @elseif ($feature == \App\Helper\Enumeration\SchoolFeature::Group)

      {{-- DISPLAY GROUP(selected):SUBJECTS TO PICK FROM --}}

      @foreach ($links as $link)

        <div class="mb-1 text-center">
          <a class="button button-route curvy-0"
              href="{{ url($link) }}">
            {{ $subjects[$loop->index]->subjectName }}
          
          </a>

        </div>

      @endforeach

    @elseif ($feature == \App\Helper\Enumeration\SchoolFeature::Subject)

      {{-- DISPLAY FORM --}}

      <livewire:grade.grade-form  :group="$group"
                                  :subject="$subject" />

    @endif

  </div>

@endsection