<div class="w-100">

  <!-- grupa-dropdown -->
  <div class="mb-1 text-center">

    <select wire:model.blur="grupaId"
            class="w-min-128 b-2 border-green font-l pointer reset-style curvy-0 font-interactable single p-0">

      @foreach ($groups as $group)

        <option wire:key="{{ $loop->index }}"
                value="{{ $group->id }}">
          {{ $group->name }}
        
        </option>

      @endforeach

    </select>

    @error('grupaId')

      <div class="mt-1 pl-1">

        <span class="font-error">{{ $message }}</span>

      </div>

    @enderror

  </div> <!-- /grupa-dropdown -->

  <!-- nazwa -->
  <div class="mb-1">

    <div class="mb-04 pl-1">

      <label  for="nazwa"
              class="pointer font-s">{{ __("Title") }}</label>

    </div>

    <div>
      
      {{-- obfuscate database attribute names --}}
      {{-- polish language obfuscates name="attribute" --}}
      <input  wire:model.blur="nazwa"
              class="highlight w-100"
              id="nazwa"
              required />

    </div>

    @error('nazwa')

      <div class="mt-1 pl-1">

        <span class="font-error">{{ $message }}</span>

      </div>
          
    @enderror

  </div> <!-- /nazwa -->

  <!-- opis -->
  <div class="mb-1">

    <div class="mb-04 pl-1">

      <label  for="opis"
              class="pointer font-s">{{ __("Description (Optional)") }}</label>

    </div>

    <div>

      {{--
        VULNERABILITY PREVENTION
        dont name input like in database
      --}}
      <textarea wire:model.blur="opis"
                class="w-100"
                id="opis"></textarea>

    </div>

    @error('opis')

      <div class="mt-1 pl-1">

        <span class="font-error">{{ $message }}</span>

      </div>
          
    @enderror

  </div> <!-- /opis -->

  <!-- datetimes -->
  <div class="mb-1 flexbox">

    <!-- kiedy -->
    <div class="hex-fill p-0 mr-1">

      <div class="mb-04 pl-1">

        <label  for="kiedy"
                class="pointer font-s">{{ __("When") }}</label>

      </div>

      <div>

        {{--
          VULNERABILITY PREVENTION
          dont name input like in database
        --}}
        <input  wire:model.blur="kiedy"
                {{-- DATE --}}
                type="date"
                class="w-100"
                id="kiedy" />

      </div>

      @error('kiedy')

        <div class="mt-1 pl-1">

          <span class="font-error">{{ $message }}</span>

        </div>
            
      @enderror

    </div> <!-- /kiedy -->

    <!-- od-ktorej -->
    <div class="hex-fill p-0 mr-1">

      <div class="mb-04 pl-1">

        <label  for="odKtorej"
                class="pointer font-s">{{ __("From.time") }}</label>

      </div>

      <div>

        {{--
          VULNERABILITY PREVENTION
          dont name input like in database
        --}}
        <input  wire:model.blur="odKtorej"
                {{-- TIME --}}
                type="time"
                class="w-100"
                id="odKtorej" />

      </div>

      @error('odKtorej')

        <div class="mt-1 pl-1">

          <span class="font-error">{{ $message }}</span>

        </div>
            
      @enderror

    </div> <!-- /od-ktorej -->

    <!-- do-ktorej -->
    <div class="hex-fill p-0">

      <div class="mb-04 pl-1">

        <label  for="doKtorej"
                class="pointer font-s">{{ __("Until.time") }}</label>

      </div>

      <div>

        {{--
          VULNERABILITY PREVENTION
          dont name input like in database
        --}}
        <input  wire:model.blur="doKtorej"
                {{-- TIME --}}
                type="time"
                class="w-100"
                id="doKtorej" />

      </div>

      @error('doKtorej')

        <div class="mt-1 pl-1">

          <span class="font-error">{{ $message }}</span>

        </div>
            
      @enderror

    </div> <!-- /do-ktorej -->
  
  </div>

  <!-- send-button -->
  <div class="single flexbox flexbox-horizontal-right">

    <button wire:click="store()"
            class="button button-submit w-100">{{ __("Save") }}</button>

  </div> <!-- /send-button -->

  {{-- session element is not null --}}
  <x-status-bar wire:mode="statusbar"></x-status-bar>

  {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
  {{-- A good traveler is therefore an inconclusive philosopher --}}
  {{-- Is he a good programmer tho ? --}}

</div>
