@extends('layouts.welcome-user')

@section('selectbar')

  @include('Snippet.selectbar-parent-child-picker')

@endsection

@section('content-final')

  <div class="binary">
    <table class="b-0 ma">
      <tr>
        <th class="b-0 text-right">{{ __("First Name") }}:</th>
        <td class="b-0">{{ $user->fname }}</td>

      </tr>
      <tr>
        <th class="b-0 text-right">{{ __("Last Name") }}:</th>
        <td class="b-0">{{ $user->lname }}</td>
        
      </tr>
      <tr>

        @php

          $isWarning = $user->id == auth()->user()->id;
          $isWarning = $isWarning ? ! $user->hasVerifiedEmail() : false;

        @endphp

        <th class="b-0 text-right">{{ __("E-Mail") }}:</th>
        <td class="b-0 @if($isWarning) font-warning @endif">
          {{ $user->email }}
        </td>
      </tr>

      @if ($user->id == auth()->user()->id)

        <!-- is-verified -->
        <tr>

          <th class="b-0 text-right"></th>
          
          @if ($isWarning)

            <td class="b-0 font-warning">{{ __('Not verified') }}</td>

          @else

            <td class="b-0 font-ok">{{ __('Verified') }}</td>
            
          @endif
          
        </tr> <!-- /is-verified -->
          
        @if ($isWarning)

          <!-- verification-button -->
          <tr>

            <th class="b-0"></th>
            
            <td class="b-0">

              <form action="{{ route('verification.send') }}"
                    method="post">

                @csrf

                <button class="button button-route font-s">{{ __("Send Verification E-Mail") }}</button>

              </form>

              <div class="mt-04">
              
                <span class="font-s">{{ session('emailVerificationMessage', '') }}</span>
              
              </div>
              
            </td>
            
          </tr> <!-- /verification-button -->
            
        @endif

      @endif      
    
    </table>

  </div>

  <div class="binary">
    <img src="{{ config('path.storage.portraitPicture') . $user->picturePath }}"
          alt="{{ __('Profile picture of') }} {{ $user->fname }} {{ $user->lname }}" />

  </div>

  {{-- Think: Parent checking Child --}}

  @if ($canEdit)

    <div class="single text-center">

      <a class="button button-route"
          href="{{ route('user.edit', ['id' => $user ?? auth()->user()->id]) }}">
          
        {{ __("Edit Data") }}
      
      </a>

    </div>

  @endif

@endsection