@extends('layouts.welcome-user')

@section('head-final')

	<title>{{ __("Nonattendance") }} | {{ config('app.name') }}</title>

@endsection

@section('content-final')

  @if ($period == \App\Helper\Enumeration\TimePeriod::None)

    {{--  DISPLAY DAYS TO PICK FROM
          count(timestamps) == count(links)
          remember this
    --}}

    @include('Snippet/nonattendance-calendar')

  @elseif ($period == \App\Helper\Enumeration\TimePeriod::Day)

    {{-- DISPLAY HOURS TO PICK FROM --}}

    @foreach ($data['links'] as $link)

      <div class="single text-center">

        <a class="button button-route curvy-0"
            href="{{ url($link) }}">
            
          {{ $data['hours'][$loop->index] }}
        
        </a>

      </div>

    @endforeach

  @elseif ($period == \App\Helper\Enumeration\TimePeriod::Hour)

    {{-- DISPLAY FORM --}}

    <livewire:nonattendance.nonattendance-form :data="$data" />

  @endif

@endsection