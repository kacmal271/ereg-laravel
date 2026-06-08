@extends('layouts.welcome-user')

@section('head-final')

	<title>{{ __("Plan a Meeting") }} | {{ config('app.name') }}</title>

@endsection

@section('content-final')

  <livewire:meeting.create-form />

@endsection