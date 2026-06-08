@extends('layouts.welcome-user')

@section('head-final')

	<title>{{ __("Edit School") }} | {{ config('app.name') }}</title>

@endsection

@section('content-final')

  <!-- outer-form-wrapper -->
  <div class="single">

    <form action="{{ route('school.update') }}"
        method="post"
        class="w-100">
    
      @method('patch')
          
      @csrf

      <!-- inner-form-wrapper -->
      <div class="flexbox w-100">

        <!-- school-data -->
        <div class="binary">

          <!-- school-title -->
          <div class="mb-1">

            <div class="mb-04 pl-1">

              <label  for="schoolTitle"
                      class="pointer font-s">{{ __('Full School Name') }}</label>

            </div>

            <div class="mb-04">

              <input  name="schoolTitle"
                      class="highlight w-100"
                      id="schoolTitle"
                      value="{{ $school->name }}"
                      required />

            </div>

            @error('schoolTitle')

              <div class="pl-1">

                <span class="font-error">{{ $message }}</span>

              </div>
                  
            @enderror

          </div> <!-- /school-title -->

          <!-- school-emblem-wrapper -->
          <div class="binary-fill text-center p-0">

            <!-- javascript -->
            <div class="hidden">

              {{-- functionality: update school emblem --}}
              @include('Snippet.School.school-create-logo')

            </div> <!-- /javascript -->

            <!-- school-emblem -->
            <div class="relative inline-block m-1">

              <label class="icon-holder-256">

                <input  name='imageFile'
                        type='file'
                        {{-- APACHE: Validate mime type --}}
                        accept='image/*'
                        class="hidden"
                        id='imageFile' />

                      {{-- VIEW COMPOSER: AppComposer: $logo --}}
                <img  src="{{ $logo }}"
                      alt="{{ __('School current logo or placeholder') }}"
                      class="w-100"
                      id="logo" />

              </label>

            </div> <!-- /school-emblem -->

            @error('imageFile')

              <div>

                <span class="font-error">{{ $message }}</span>

              </div>
                
            @enderror

          </div> <!-- /school-emblem-wrapper -->

        </div> <!-- /school-data -->

        <!-- school-year-data -->
        <div class="binary">

          <!-- academic-period -->
          <div class="mb-1">

            <div class="mb-04 pl-1">

              <label  for="academicPeriod"
                      class="nowrap pointer font-s">{{ __("School Year") }}</label>

            </div>

            <div class="mb-04">

              <input  name="academicPeriod"
                      class="w-100"
                      id="academicPeriod"
                      value="{{ $school->schoolYear }}"
                      required />
              
              <span class="font-s text-center block font-info">{{ __('Format: "2000/01"') }}</span>

            </div>

            @error('academicPeriod')

              <div class="pl-1">

                <span class="font-error">{{ $message }}</span>

              </div>
                
            @enderror

          </div> <!-- /academic-period -->

          <!-- school-start -->
          <div class="mb-1">

            <div class="mb-04 pl-1">

              <label  for="schoolStart"
                      class="nowrap pointer font-s">{{ __('First School Day') }}</label>

            </div>

            <div class="mb-04">

              {{-- VULNERABILITY PREVENTION --}}
              {{-- dont name input like in database --}}
              <input  name="schoolStart"
                      class="w-100 @error('schoolStart') error @enderror"
                      id="schoolStart"
                      type="date"
                      value="{{ $school->firstDay->format('Y-m-d') }}"
                      required />
              
              <span class="font-s text-center block font-info">{{ __('Day of Inauguration') }}</span>

            </div>

            @error('schoolStart')

              <div class="pl-1">

                <span class="font-error">{{ $message }}</span>

              </div>
                
            @enderror

          </div> <!-- /school-start -->

          <!-- school-end -->
          <div class="mb-1">

            <div class="mb-04 pl-1">

              <label  for="schoolEnd"
                      class="nowrap pointer font-s">{{ __('Last School Day') }}</label>

            </div>

            <div class="mb-04">

              {{-- VULNERABILITY PREVENTION --}}
              {{-- dont name input like in database --}}
              <input  name="schoolEnd"
                      class="@error('schoolEnd') error @enderror w-100"
                      id="schoolEnd"
                      type="date"
                      value="{{ $school->lastDay->format('Y-m-d') }}"
                      required />
              
              <span class="font-s text-center block font-info">{{ __('End of School year') }}</span>

            </div>

            @error('schoolEnd')

              <div class="pl-1">

                <span class="font-error">{{ $message }}</span>

              </div>
                
            @enderror

          </div> <!-- /school-start -->

        </div> <!-- school-year-data -->

        <!-- save-button -->
        <div class="single">

          <button class="button button-submit w-100">{{ __("Save") }}</button>

        </div> <!-- /save-button -->

      </div> <!-- /inner-form-wrapper -->
    
    </form>

  </div> <!-- /outer-form-wrapper -->

  @if(session()->has('status'))

    <!-- statusbar -->

    @include('Snippet.statusbar', [
      'status' => session('status', ''),
      'statusbarMessage' => session('statusbarMessage', '')
    ])
    
    <!-- /statusbar -->

  @endif

@endsection