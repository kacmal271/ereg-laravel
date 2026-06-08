@extends('layouts.welcome-user')

@section('head-final')

	

@endsection

@section('content-final')

  @use('\App\Helper\Enumeration\Students')

  <div class="single">

    @switch ($who)

      @case (Students::School)

        {{-- DISPLAY GROUPS TO PICK FROM --}}
        {{-- DISPLAY GROUPS TO PICK FROM --}}
        {{-- DISPLAY GROUPS TO PICK FROM --}}

        @foreach ($links as $link)

          <div class="mb-04 text-center">

            <a class="button button-route curvy-0"
                href="{{ url($link) }}">

              {{ $groups[$loop->index]->name }}
            
            </a>

          </div>

        @endforeach

      @break

      @case (Students::Group)

        {{-- DISPLAY STUDENTS TO PICK FROM --}}
        {{-- DISPLAY STUDENTS TO PICK FROM --}}
        {{-- DISPLAY STUDENTS TO PICK FROM --}}

        <table class="b-0 w-min-512 responsive nowrap ma">

          <tr class="text-left background-transparent">

            <th class="b-0">{{ __('ID') }}</th>
            <th class="b-0">{{ __('First Name') }}</th>
            <th class="b-0">{{ __('Last Name') }}</th>

          </tr>

          @foreach ($students as $commonKey => $student)

            {{-- (B) Primary Route --}}
            <tr onclick="window.location='{{ $links[$commonKey] }}'"
                class="@if($loop->last) bb-1 @endif pointer bt-1 background-interactable hover-lighten border-white">

              <td class="b-0">
              
                {{-- (B) Backup Route (it's the same) --}}
                <a  href=" {{ $links[$commonKey] }}"
                    class="block font-text">

                  <span>{{ $student->id }}</span>
                
                </a>

              </td>

              <td class="b-0">{{ $student->fname }}</td>
              <td class="b-0">{{ $student->lname }}</td>

            </tr>

          @endforeach

        </table>
      
      @break

      @case (Students::Student)

        {{-- DISPLAY FORM --}}
        {{-- DISPLAY FORM --}}
        {{-- DISPLAY FORM --}}

        <form action="{{ route('praise.store') }}"
              method="post">

          @csrf

          @method('put')

          <input  name="sId"
                  value="{{ $student->id }}"
                  type="hidden" />

          <!-- is-it-notice-wrapper -->
          <div class="text-center">

            <!-- is-it-notice -->
            <div class="inline-block">

              <!-- praise -->
              <label class="radio">

                <div class="radio-positioner">

                  <input  value="0"
                          type="radio"
                          name="isItNotice"
                          checked />
                
                  <div class="radio-container"></div>

                </div>
                
                <span class="font-l radio-text">
                
                  {{ __('Praise') }}

                </span>

              </label> <!-- /praise -->

              <!-- notice -->
              <label class="radio">

                <div class="radio-positioner">

                  <input  value="1"
                          type="radio"
                          name="isItNotice" />
                
                  <div class="radio-container"></div>

                </div>
                
                <span class="font-l radio-text">
                
                  {{ __('Notice') }}

                </span>

              </label> <!-- /notice -->

            </div> <!-- /is-it-notice -->

            @error('isItNotice')

              <div class="mt-04 text-center">
                <span class="font-error">{{ $message }}</span>
              </div>

            @enderror

          </div> <!-- /is-it-notice-wrapper -->

          <!-- header -->
          <div class="single">

            <div class="mb-1 pl-1">

              <label  for="header"
                      class="pointer font-s">{{ __("Title") }}</label>

            </div>

            <div class="mb-1">

              {{--
                VULNERABILITY PREVENTION
                dont name input like in database
              --}}
              <input  name="header"
                      class="highlight w-100"
                      id="header"
                      value="{{ old('header') }}"
                      required />

            </div>

            @error('header')

              <div class="pl-1">

                <span class="font-error">{{ $message }}</span>

              </div>
                  
            @enderror

          </div> <!-- /header -->

          <!-- message -->
          <div class="single">

            <div class="mb-1 pl-1">

              <label  for="message"
                      class="pointer font-s">{{ __("Description (Optional)") }}</label>

            </div>

            <div class="mb-1">

              {{--
                VULNERABILITY PREVENTION
                dont name input like in database
              --}}
              <textarea name="message"
                        class="b-1 w-100"
                        id="message"
                        required>{{ old('message') }}</textarea>

            </div>

            @error('message')

              <div class="pl-1">

                <span class="font-error">{{ $message }}</span>

              </div>
                  
            @enderror

          </div> <!-- /message -->

          <!-- send-button -->
          <div class="single flexbox flexbox-horizontal-right">

            <button class="button button-submit w-100">{{ __("Send") }}</button>

          </div> <!-- /send-button -->

        </form>

        {{-- session element is not null --}}
        <x-status-bar></x-status-bar>

      @break

    @endswitch

  </div>

@endsection