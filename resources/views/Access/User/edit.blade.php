@extends('layouts.welcome-user')

@section('content-final')

  <form action="{{ route('user.update', ['id' => $user->id]) }}"
        method="post"
        class="w-100">
    
    @method('patch')

    @csrf

    <div class="single flexbox p-0">

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
            <th class="b-0 text-right">
              <label for="email">{{ __("E-Mail") }}:</label>
            
            </th>

            <td class="b-0">

              {{-- EMAIL --}}

              <div>

                <input type="text"
                        class="highlight"
                        name="email"
                        value="{{ old('email') ?? $user->email }}"
                        id="email"
                        autocomplete="off" />
              
              <div>

            </td>
            
          </tr>

          @error('email')
          
            <tr>
              {{-- padding --}}
              <th class="b-0 text-right"></th>

              <td class="b-0">

                {{-- EMAIL: Error --}}

                  <span class="font-error">{{ $message }}</span>

              </td>
              
            </tr>

          @enderror
        
        </table>

      </div>

      <div class="binary flexbox flexbox-horizontal">

        <img src="{{ config('path.storage.portraitPicture') . $user->picturePath }}"
              alt="{{ __('Profile picture of') }} {{ $user->fname }} {{ $user->lname }}" />

      </div>

      <div class="single">

        {{--BUTTON --}}

        <div class="text-center">

          <button class="button button-submit">{{ __("Save") }}</button>

        </div>

      </div>

    </div>

  </form>

@endsection