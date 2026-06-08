<div>

  @if ($title != null && $title != '')

    <div class="mb-1 pl-1">
      <span class="pointer font-s">{{ __($title) }}</label>

    </div>

  @endif

  <div class="popup-parent" tabindex="0">
    <!-- placeholder -->
    <div class="popup-thumbnail pointer">
      <input wire:model.fill.blur="searchString"
              autocomplete="off"
              class="w-100"
              placeholder="{{ __($placeholder) }}"
              value="{{ old('usersString') }}"
              disabled />
            
    </div> <!-- /placeholder -->

    <!-- POPUP CONTENT -->

    <div class="popup-child w-100 absolute-left-top">
      <!-- input -->
      <div>
        <input wire:model.fill.live.debounce.250ms="searchString"
                autocomplete="off"
                class="w-100"
                id="usersString"
                name="usersString"
                placeholder="{{ __($placeholder) }}"
                value="{{ old('usersString') }}" />

      </div> <!-- /input -->

      <!-- output -->
      <div class="inline-block relative">

        <!-- output-background -->
        <div class="popup-child-background"></div>
        <!-- /output-background -->

        <!-- output-list -->
        <div class="inline-block navigation-vertical">
        
          @foreach ($usersString as $userString)

            <button type="button"
                    wire:key="{{ $loop->index }}"
                    wire:click="addUser({{ $userString->id }})"
                    class="p-1 font-m nowrap hover-lighten font-text-alt text-left bb-1 navigation-vertical-element">
              {{ $userString->userString }}
            
            </button>

          @endforeach

        </div> <!-- output-list -->

      </div> <!-- /output -->
    
    </div> <!-- / POPUP CONTENT, BACKGROUND -->

  </div>

  @error ('usersString')

    <div class="p-1">
      <span class="font-error">{{ __($message) }}</span>
    
    </div>

  @enderror

  {{-- Success is as dangerous as failure. --}}

</div>
