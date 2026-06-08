@extends('layouts.mail')

@section('head-final')

  

@endsection

@section('content-final')

  <!-- mails -->
  <table class='b-0 w-100 mb-1 responsive-headless'>

    @foreach($paginatedMails as $mail)

      <!-- mail -->
      {{-- (B) Primary Route --}}
      <tr onclick="window.location='{{ route('mail.show', [$mailCategory, $mail['id'] ]) }}'"
          class=" @if($loop->last) bb-1 @endif pointer bt-1 background-interactable hover-lighten border-white toggle-show-children-hover">
        <td class='b-0 w-25 overflow-hidden nowrap'>
          {{-- (B) Backup Route (it's the same) --}}
          <a href="{{ route('mail.show', [$mailCategory, $mail['id'] ]) }}"
              class="font-text">
            <span>{{ $mail['user.prefix'] }}</span>
            <span class="font-s">{{ $mail['user.users'] }}</span>
          
          </a>
        
        </td>

        <td class='b-0 w-50 overflow-hidden nowrap'>{{ $mail['title'] }}</td>

        <td class='b-0 w-25 overflow-hidden nowrap text-right'>
          <div class="relative toggle-show-hidden-child text-left">
            {{-- Condition: <tr> is displayed as block --}}
            {{-- Problem: image appearing shifts <tr> towards bottom --}}
            {{-- Solution: add white char --}}
            &nbsp;
            {{-- Condition:<tr> is displayed normally --}}
            {{-- Problem: image appearing shifts <tr> towards bottom --}}
            {{-- Solution: image has to be positioned: absolutely --}}
            <span class="absolute-right-center">
              <form action="{{ route('mail.destroy', ['mail' => $mail['id']]) }}"
                    method="post">

                @csrf

                @method('delete')

                <button class="reset-style">
                  <!-- height of image: height of font -->
                  <img src="{{ url('style/BiWork/icon-trash-white.svg') }}"
                        alt="x"
                        class="h-1 button-icon" />

                </button>
              
              </form>
          
            </span>

          </div>
          
          <span class="toggle-show-visible-child">
            {{ $mail['sentOnPretty'] }}
          
          </span>
        
        </td>

      </tr> <!-- /mail -->
    
    @endforeach
  
  </table> <!-- /mails -->

  {{ $paginatedMails->links() }}

@endsection

