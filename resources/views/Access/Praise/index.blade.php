@extends('layouts.welcome-user')

@section('selectbar')

  @include('Snippet.selectbar-parent-child-picker')

@endsection

@section('content-final')

  <div class="single flexbox flexbox-horizontal">

    @foreach ($praises as $praise)

      <!-- praise-wrapper -->
      <div class="quart">

        <!-- praise -->
        <div class="p-1 @if($praise->isNotice) background-red-quart @else background-green-quart @endif">

          <!-- header -->
          <div class="mb-04">
            <h6 class="font-text">{!! $praise->title !!}</h6>
          </div> <!-- /header -->

          <!-- message -->
          <div class="mb-04 text-justify">
            <span>{!! $praise->description !!}</span>
          </div> <!-- /message -->

          <!-- teacher -->
          <div class="font-text-alt">
            <span class="block nowrap">{{ __('Submitted by:') }}</span>
            <span class="block nowrap">
              &lt;{{ $praise->teacher->id }}&gt;
              {{ $praise->teacher->fname }}
              {{ $praise->teacher->lname }}
            </span>
          </div> <!-- /teacher -->

        </div> <!-- /praise -->

      </div> <!-- /praise-wrapper -->

    @endforeach

  </div>

@endsection