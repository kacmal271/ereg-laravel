@extends('layouts.welcome-user')

@section ('head-final')

  <title>{{ __("Add User") }} | {{ config('app.name') }}</title>

@endsection

@section('content-final')

  <div class="single">

    <form method="post"
          action="{{ route('user.store', ['code' => $role->code]) }}"
          enctype="multipart/form-data">

      {{-- hidden inputs --}}

      @csrf

      @method('put')

      <!-- flexbox -->
      <div class="flexbox">

        @if ( ( (config('role.parent.code') | config('role.student.code') ) & $role->code ) > 0)

          <!-- required-header -->
          <div class="single">

            <h6>{{ __('Required Information') }}</h6>
          
          </div> <!-- /required-header -->
        
        @endif

        @switch ($role->code)

          @case (config('role.parent.code'))

            <!-- students -->
            <div class="single">

              <livewire:user-picker :usersString="[]"
                                    placeholder=""
                                    title="{{ __('Associated Students') }}"
                                    :userFormat="$searchboxFormat" />

            </div> <!-- /students -->
          
          @break
          
          @case (config('role.student.code'))
          
            <!-- groups -->
            <div class="single text-center">

              <!-- groups-picker -->
              <div class="inline-block">

                <div class="text-left mb-04 pl-1">

                  <label for="group" class="pointer font-s">{{ __("Group") }}</label>

                </div>

                <div>

                  <select class="b-04 w-min-128 reset-style curvy-0 font-interactable p-0"
                          id="group"
                          name="group">

                    @foreach ($groups as $group)

                      <option value="{{ $group->id }}">{{ $group->name }}</option>

                    @endforeach

                  </select>

                </div>

              </div> <!-- /groups-picker -->

              @error('group')

                <!-- groups-error -->
                <div>

                  <span class="font-error">{{ $message }}</span>

                </div> <!-- /groups-error -->
                  
              @enderror
            
            </div> <!-- /groups -->
          
          @break

        @endswitch

        <!-- add-user-header -->
        <div class="single">

          <h6>{{ __('New.masculine') }} {{ __(ucfirst($role->name)) }}</h6>
        
        </div> <!-- /add-user-header -->

        <div class="single flexbox">

          <!-- account-data -->
          <div class="binary-fill p-0">

            <div class="binary flexbox mb-1 p-0">

              <!-- first-name -->
              <div class="binary p-0 pr-04">

                <div class="mb-04 pl-1">

                  <label for="firstName" class="pointer font-s">{{ __("First Name") }}</label>

                </div>

                <div>
                  {{-- VULNERABILITY PREVENTION --}}
                  {{-- dont name input like in database --}}
                  <input  name="firstName"
                          autocomplete="off"
                          class="w-100"
                          id="firstName"
                          value="{{ old('firstName') }}"
                          required />

                </div>

                @error('firstName')

                  <div>

                    <span class="font-error">{{ $message }}</span>

                  </div>
                    
                @enderror

              </div> <!-- /first-name -->

              <!-- last-name -->
              <div class="binary p-0 pl-04">

                <div class="mb-04 pl-1">

                  <label for="lastName" class="pointer font-s">{{ __("Last Name") }}</label>

                </div>

                <div>
                  {{-- VULNERABILITY PREVENTION --}}
                  {{-- dont name input like in database --}}
                  <input  name="lastName"
                          autocomplete="off"
                          class="w-100"
                          id="lastName"
                          value="{{ old('lastName') }}"
                          required />

                </div>

                @error('lastName')

                  <div>

                    <span class="font-error">{{ $message }}</span>

                  </div>
                    
                @enderror

              </div> <!-- /last-name -->

            </div>

            <!-- email-address -->
            <div class="mb-1">

              <div class="mb-04 pl-1">

                <label for="email" class="pointer font-s">{{ __("E-Mail (Optional)") }}</label>

              </div>

              <div>
                {{-- VULNERABILITY PREVENTION --}}
                {{-- dont name input like in database --}}
                <input  name="email"
                        autocomplete="off"
                        class="w-100"
                        id="email"
                        type="email"
                        value="{{ old('email') }}" />

              </div>

              @error('email')

                <div>

                  <span class="font-error">{{ $message }}</span>

                </div>
                  
              @enderror

            </div> <!-- /email-address -->

            <!-- passwords -->
            <div class="binary flexbox mb-1 p-0">

              <!-- password -->
              <div class="binary p-0 pr-04">

                <div class="mb-04 pl-1">

                  <label for="password" class="pointer font-s">{{ __("Password") }}</label>

                </div>

                <div>
                  {{-- VULNERABILITY PREVENTION --}}
                  {{-- dont name input like in database --}}
                  <input  name="password"
                          autocomplete="off"
                          class="w-100"
                          id="password"
                          type="password"
                          required />

                </div>

                @error('password')

                  <div>

                    <span class="font-error">{{ $message }}</span>

                  </div>
                    
                @enderror

              </div> <!-- /password -->

              <!-- password-confirm -->
              <div class="binary p-0 pl-04">

                <div class="mb-04 pl-1">

                  <label for="password_confirmation" class="pointer font-s">{{ __("Confirm Password") }}</label>

                </div>

                <div>
                  {{-- VULNERABILITY PREVENTION --}}
                  {{-- dont name input like in database --}}
                  <input  name="password_confirmation"
                          autocomplete="off"
                          class="w-100"
                          id="password_confirmation"
                          type="password"
                          required />

                </div>

                @error('password_confirmation')

                  <div>

                    <span class="font-error">{{ $message }}</span>

                  </div>
                    
                @enderror

              </div> <!-- /password-confirm -->

            </div> <!-- /passwords -->

          </div> <!-- /account-data -->

          <!-- portrait-picture-wrapper -->
          <div class="binary-fill text-center p-0">

            <!-- javascript -->
            <div class="hidden">

              {{-- functionality: update portrait picture --}}
              @include('Snippet.User.user-create-portraitPicture')

            </div> <!-- /javascript -->

            <!-- portrait-picture -->
            <div class="relative inline-block m-1">

              <label>

                <input type='file'
                        {{-- APACHE: Validate mime type --}}
                        accept='image/*'
                        class="hidden"
                        id='imageFile'
                        name='imageFile' />

                <img src="{{ config('path.raster') . '/profile-picture-placeholder-200-300.jpg' }}"
                      alt="{{ __('Portrait picture placeholder') }}"
                      height="{{ config('image.portraitPicture.height') }}"
                      id="portraitPicture"
                      width="{{ config('image.portraitPicture.width') }}" />

              </label>
                
              <!-- width -->
              <span class="absolute-center-bottom-overhang"
                    id="imageWidthText">
                {{ __('Width') }}&#x3A;&nbsp;{{ config('image.portraitPicture.width') }}
              </span>
              <!-- /width -->

              <!-- height -->
              <span class="absolute-right-center-overhang">
                <span class="block"
                      id="imageHeightText"
                      style="transform: translate(-25%, 0) rotate(90deg);">
                  {{ __('Height') }}&#x3A;&nbsp;{{ config('image.portraitPicture.height') }}
                </span>
              </span>
              <!-- /height -->

            </div> <!-- /portrait-picture -->

            @error('imageFile')

              <div>

                <span class="font-error">{{ $message }}</span>

              </div>
                
            @enderror

          </div> <!-- /portrait-picture-wrapper -->

        </div>

        <!-- send -->
        <div class="single">
          
          <button class="button button-submit w-100" type="submit">{{ __('Send') }}</button>

        </div> <!-- /send -->

      </div> <!-- /flexbox -->

    </form>

  </div>

@endsection