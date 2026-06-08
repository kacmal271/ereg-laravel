<div>

  <!-- assessment-picker -->
  <div class="text-center">

    <select wire:model="assessmentId"
            class="reset-style curvy-0 font-interactable single p-0">

      @foreach ($assessments as $assessment)

        <option wire:key="{{ $loop->index }}"
                value="{{ $assessment->id }}"
                @selected($loop->first)>
          {{ $assessment->name }}
        
        </option>

      @endforeach

    </select>

    @error('assessmentId')

      <span class="block font-error">{{ $message }}</span>

    @enderror

  </div> <!-- /assessment-picker -->

  <!-- tabelarized-form -->
  <div class="mt-1">

    <table class="b-0 ma">
      <tr>
        <th class="b-0">ID</th>
        <th class="b-0 pl-1">{{ __('Student') }}</th>
        <th class="b-0 pl-1">{{ __('Grade') }}</th>
      
      </tr>

      @foreach ($group->students as $key => $student)

        <!-- student -->
        <tr wire:key="{{ $loop->index }}">

          <td class="b-0">
            
            {{ $student->id }}

            <input  wire:model.fill="newGrade.{{ $key }}.userId"
                    value="{{ $student->id }}"
                    type="hidden" />
          
          </td>
        
          <td class="b-0 pl-1"> {{ $student->fname }} {{ $student->lname }} </td>
        
          <td class="text-center b-0 pl-1">
          
            <input  wire:model="newGrade.{{ $key }}.grade"
                    class="hide-spin-buttons w-4"
                    type="number" />

          </td>

        </tr> <!-- /student -->

        @error("newGrade.$key.grade")

          <!-- student-error -->
          <tr>
          
            <td class="b-0 pl-1" colspan="3">
            
              <span class="block font-error">{{ $message }}</span>

            </td>

          </tr> <!-- /student-error -->

        @enderror

      @endforeach <!-- student data -->

      <!-- send-button -->
      <tr>

        <td class="b-0"></td>
      
        <td class="b-0"></td>

        <td class="b-0 pl-1">
        
          <button wire:click="store()"
                  class="w-100 button button-submit">
            {{ __("Save Filled") }}
          
          </button>

        </td>

      </tr> <!-- /send-button -->
    
    </table>

  </div> <!-- /tabelarized-form -->

  @if($status != null)

    <!-- statusbar -->

    @include('Snippet.statusbar', [
      'status' => $status,
      'statusbarMessage' => $statusbarMessage
    ])
    
    <!-- /statusbar -->

  @endif

  {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

</div>
