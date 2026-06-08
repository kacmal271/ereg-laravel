{{-- CONTROLLER --}}
{{-- CONTROLLER --}}
{{-- CONTROLLER --}}

@php

  use \App\Helper\Translator;
  use \App\Helper\Extended\DateTime;

  $email = empty(auth()->user()->email) ? "" : auth()->user()->email;

  $previousLogIn = 
  strtolower(
    Translator::translate(
      DateTime::dateTimeAgo(
        auth()->user()->previousLogIn ?? ""
      ) // : returned "7 days ago"
    ) // : translated "7 dni temu"
  );

@endphp

{{-- VIEW --}}
{{-- VIEW --}}
{{-- VIEW --}}

<div class="button button-button animatePopDont">
  <div class="popup-parent" tabindex="0">
    <div class="popup-thumbnail">
      <img  class="icon-holder-64"
            src="{{url('/svg/icon-profile-white.svg')}}"
            alt="profile of a person, head and torso" />
            
    </div>

     <!-- POPUP CONTENT, BACKGROUND -->

    <div class="popup-child popup-child-auto popup-child-bottom-left p-1">

      <div class="popup-child-background curvy-1"></div>
      
      <!-- POPUP CONTENT -->

      <div class="p-1 text-left">
      
        <div class="mb-1 nowrap">

          <span class="font-text">{{ __("My ID") }}:</span>

          <span class="font-username">{{ auth()->user()->id }}</span>

        </div>

        <div class="mb-1 nowrap">

          <span class="font-text">{{ __("My E-Mail") }}:</span>

          <span class="font-text-alt">{{ $email }}</span>

        </div>
        
        <div class="mb-1 nowrap">

          <span class="font-text">{{ __("Previous Log-in") }}</span>

          <span class="font-date">{{ $previousLogIn ?? __('N/A') }}</span>

        </div>
        
        <div class="navigation-vertical">
          <a class="button button-route reset-style navigation-vertical-element"
              href="{{ route('auth.logout', []) }}">
              {{ __("Log out") }}
          
          </a>

        </div>

      </div> <!-- / POPUP CONTENT -->
    
    </div> <!-- / POPUP CONTENT, BACKGROUND -->

  </div>

</div>