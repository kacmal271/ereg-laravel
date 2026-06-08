@extends('layouts.mail')

@section('head-final')

	<title>{{ __("Compose Mail") }} | {{ config('app.name') }}</title>

@endsection

@section('content-final')

  <form method="post"
        action="{{ route('mail.store') }}"
				enctype="multipart/form-data">

    @csrf

    @method('put')

    <!-- receivers -->
    
    <div class="single">
      
      <livewire:user-picker :usersString="[]"
                            placeholder="{{ __('To:') }}"
                            title=""
                            :userFormat="$searchboxFormat" />

    </div>

    <!-- /receivers -->

    <!-- subject -->
    <div class="flexbox">
      <div class="single">
        {{-- VULNERABILITY PREVENTION --}}
        {{-- dont name input like in database --}}
        <input  name="subject"
                autocomplete="off"
                value="{{ old('subject') }}"
                placeholder="{{ __('Subject.topic') }}"
                class="w-100"
                required />

      </div>

      @error('subject')
        <div class="single">
          <span class="font-error">{{ $message }}</span>

        </div>
          
      @enderror

    </div> <!-- /subject -->

    <!-- mail -->
    <div class="flexbox">
      <div class="single">
        {{-- VULNERABILITY PREVENTION --}}
        {{-- dont name input like in database --}}
        <textarea name="mail"
                  class="w-100 vh-25-initial">{{ old('mail') }}</textarea>

      </div>

      @error('mail')
        <div class="single">
          <span class="font-error">{{ $message }}</span>

        </div>
          
      @enderror

    </div> <!-- /mail -->

    <div class="hidden">

      {{-- functionality: attachments adding --}}
      @include('Snippet.Mail.mail-create-attachments')

    </div>

    <!-- attachments -->
    <div class="single flexbox"
          id="mail-create-attachments-attachments">

      {{-- <div class="hex">Attachment One</div> --}}
      {{-- <div class="hex">Attachment Two</div> --}}

    </div> <!-- /attachments -->

    <!-- send-bar -->
    <div class="single flexbox flexbox-vertical">
      
      <!-- send -->
      <div class="hex">
        <button class="button button-submit w-min-128"
                type="submit">{{ __('Send') }}</button>

      </div> <!-- /send -->

      <!-- add-attachment -->
      <div class="hex">
        <button class="button button-attachment button-icon"
                type="button"
                title="{{ __('Add Attachment') }}"
                id="mail-create-attachments-add"></button>
        
      </div> <!-- /add-attachment -->

    </div> <!-- /send-bar -->

  </form>

@endsection

