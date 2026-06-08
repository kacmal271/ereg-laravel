<div class="single flexbox">

  {{-- SCHEDULE --}}
  {{-- SCHEDULE --}}
  {{-- SCHEDULE --}}

  @if (empty($daySchedule))

    <div class="single text-center">
      <span>{{ __('N/A') }}</span>
    
    </div>
  
  @else

    <!-- lessons-padding -->
    <table class="single b-0">

      @foreach ($daySchedule as $index => $lesson)
        {{-- $daySchedule:
               sorted array
               didnt preserve int-key order (0, 9, 1, ..)
        --}}

        <!-- lesson -->
          <tr wire:key="{{ $loop->index }}" class="b-1 text-left">
            <!-- lesson: hours -->
            <td class="b-0">
              <input  wire:model="daySchedule.{{ $index }}.start"
                      class="reset-style font-time w-4 block" disabled />

              <input  wire:model="daySchedule.{{ $index }}.end"
                      class="reset-style font-time-alt w-4 block" disabled />

            </td> <!-- /lesson: hours -->

            <!-- lesson: subject + teacher -->
            <td class="b-0">
              <input  wire:model="daySchedule.{{ $index }}.subject"
                      class="reset-style font-text block w-100" disabled />

              <input  wire:model="daySchedule.{{ $index }}.teacher"
                      class="reset-style font-text-alt block w-100" disabled />

            </td> <!-- /lesson: subject + teacher -->

          </tr> <!-- /lesson -->

      @endforeach

    </table> <!-- /lessons-padding -->

  @endif

  {{-- FORM --}}
  {{-- FORM --}}
  {{-- FORM --}}

  <form wire:submit.prevent="store">

    @csrf

    <!-- lesson-new-padding -->
    <div class="single flexbox p-0 mt-1">
      
      <!-- lesson-new -->
      <table class="b-1 mb-1 text-left w-100">
        <tr>
          <!-- lesson-new: hours -->
          <td class="b-0">
            <input wire:model="startTime"
                    type="time"
                    class="reset-style curvy-0 outline-0 font-interactable" />

            <input wire:model="endTime"
                    type="time"
                    class="reset-style curvy-0 outline-0 font-interactable" />

          </td> <!-- /lesson-new: hours -->
          
          <!-- lesson-new: subject + teacher -->
          <td class="b-0">

            <!-- subject-teacher wrapper -->
            <div class="flexbox">

              <!-- subject -->
              <select wire:model="subjectId"
                      class="reset-style curvy-0 font-interactable single p-0">

                @foreach ($subjects as $subject)

                  <option wire:key="{{ $loop->index }}"
                          value="{{ $subject->id }}">
                    {{ $subject->abbreviation }}
                  
                  </option>

                @endforeach

              </select> <!-- /subject -->

              <!-- teacher -->
              <select wire:model="teacherId"
                      class="reset-style curvy-0 font-interactable single p-0">

                @foreach ($teachers as $teacher)

                  <option wire:key="{{ $loop->index }}"
                          value="{{ $teacher->id }}">
                    {{ "{$teacher->id} {$teacher->lname}" }}
                  
                  </option>

                @endforeach

              </select> <!-- /teacher -->

            </div> <!-- /subject-teacher wrapper -->

          </td> <!-- /lesson-new: subject + teacher -->

        </tr>

      </table> <!-- /lesson-new -->

      <!-- lesson-new: save button -->
      <div class="w-100 text-center">
        <button class="w-100 button button-submit">{{ __('Add') }}</button>

      </div> <!-- /lesson-new: save button -->

    </div> <!-- /lesson-new-padding -->

  </form>

</div>
