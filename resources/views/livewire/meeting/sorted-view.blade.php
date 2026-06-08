<div>

  <!-- sorter-bar-wrapper -->
  <div class="mb-1 text-center">

    <!-- sorter-bar -->
    <div class="relative pr-1 inline-block">

      <!-- dropdown -->
      <div>

        <select wire:model.live.fill="dropdown"
                class="pointer">

          @foreach ($sortingProperties as $key => $property)

            <option wire:key="{{ $loop->index }}"
                    value="{{ $key }}"
                    {{-- selected --}}
                    {{-- initial option selected in SortedView::class --}}>
              {{ $property }}
            </option>

          @endforeach
        
        </select>

      </div> <!-- /dropdown -->

      <!-- order -->
      <div class="ml-1 absolute-right-center-overhang">

        <button wire:click="changeOrder(true)"
                class="absolute-center-top-overhang button button-icon animatePopDont p-0">
          ▲
        </button>

        <button wire:click="changeOrder(false)"
                class="absolute-center-bottom-overhang button button-icon animatePopDont p-0">
          ▼
        </button>

      </div> <!-- /order -->

    </div> <!-- /sorter-bar -->

  </div> <!-- /sorter-bar-wrapper -->

  <!-- meetings-wrapper -->
  <div>

    <table class="responsive ma b-0">

      @foreach ($meetings as $meeting)

        @if ($loop->first)

          {{-- table head --}}

          <tr class="mb-1 b-3">

            @foreach ($meeting as $key => $data)

              @if ( ! $loop->last)

                {{-- head loops --}}

                <th>{{ __(ucfirst($key)) }}</th>

              @endif

            @endforeach

          </tr>

        @endif

        {{-- table body --}}

        @foreach ($meeting as $key => $data)

          @php
          
            $background = $isMeetingExpired[$loop->parent->index] ? 'background-gray-quart' : 'background-green-quart';

          @endphp

          @if ($loop->first)

            {{-- first loop --}}
            
            <tr class="bt-3 br-3 bl-3 {{ $background }}">
          
          @endif

          @if ( ! $loop->last)

            {{-- middle loops --}}

            <td class="nowrap">{{ $data }}</td>

          @else

            {{-- last loop --}}

            </tr>
            
            <!-- description -->
            <tr class="mb-1 br-3 bb-3 bl-3 {{ $background }}">

              <td colspan="{{ $loop->count }}"
                  class="text-justify">
                {!! $data !!}
              </td>

            </tr> <!-- /description -->

          @endif

        @endforeach

      @endforeach

    </table>

  </div> <!-- /meetings-wrapper -->

  {{-- Because she competes with no one, no one can compete with her. --}}
  {{-- - the wise man --}}

</div>
