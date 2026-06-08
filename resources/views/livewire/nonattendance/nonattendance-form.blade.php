<div class="p-0 single">

  {{-- Close your eyes. Count to one. That is how long forever feels. --}}

  <div class="p-0 single flexbox flexbox-horizontal text-center">

    {{-- STUDENT DATA: table summary --}}

    <table class="b-0">
      <tr>
        <th class="b-0">ID</th>
        <th class="b-0 pl-1">{{ __('First Name') }}</th>
        <th class="b-0 pl-1">{{ __('Last Name') }}</th>
      
      </tr>

      @foreach ($data as $nonattendance)
        <tr wire:key="{{ $loop->index }}">
          <td class="b-0"> {{ $nonattendance['studentData']['id'] }} </td>
        
          <td class="b-0 pl-1"> {{ $nonattendance['studentData']['fN'] }} </td>
        
          <td class="b-0 pl-1"> {{ $nonattendance['studentData']['lN'] }} </td>

          {{-- IS PRESENT CHECKBOX --}}

          <td class="pl-1 b-0 responsive-headless">
            <label class="checkbox">
              <div class="checkbox-positioner">
                <input  wire:model    ="data.{{ $loop->index }}.studentData.isPresent"
                        type          ="checkbox"  />
                
                <div class="checkbox-container"></div>

              </div>

              <span class="checkbox-text">{{ __('Is Present?') }}</span>

            </label>
            

          </td>

          {{-- IS EXCUSED CHECKBOX --}}

          <td class="pl-1 b-0 responsive-headless">
            <label class="checkbox">
              <div class="checkbox-positioner">
                <input  wire:model    ="data.{{ $loop->index }}.studentData.isExcused"
                        type          ="checkbox"  />
                
                <div class="checkbox-container"></div>

              </div>

              <span class="checkbox-text">{{ __('Is Excused?') }}</span>

            </label>

          </td>

        </tr>

      @endforeach <!-- student data -->
    
    </table>

  </div> <!-- TABLE: summary -->

  {{-- BUTTON: store --}}

  <div class="single flexbox flexbox-horizontal">
    <button wire:click="store"
            class="button button-submit">
      {{ ucfirst(__("save")) }}
    
    </button>

  </div>
  
</div>
