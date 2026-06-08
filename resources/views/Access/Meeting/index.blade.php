@extends('layouts.welcome-user')

@section('head-final')

	<title>{{ __("Meetings") }} | {{ config('app.name') }}</title>

@endsection

@section('selectbar')

  @include('Snippet.selectbar-parent-child-picker')

@endsection

@section('content-final')

  <div class="single">

    <livewire:meeting.sortedView />

  </div>

@endsection