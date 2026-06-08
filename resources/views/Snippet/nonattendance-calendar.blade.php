{{--  DISPLAY DAYS
      count(timestamps) == count(links)
      remember this
--}}

@foreach ($data['timestamps'] as $year => $months)

  <div class="single flexbox flexbox-horizontal mb-4">

    {{-- (A) Here lie: 2024[] then 2023[] then .. --}}

    @foreach ($months as $month => $days)

      {{-- (A) Here lie: Dec[] then Nov[] then .. --}}

      @if ($loop->first)

        <!-- YEAR before months -->

        <div class="single text-center">
          <h5>{{ $year }}</h5>
        
        </div>
      
      @endif

      {{-- position each table --}}

      <div class="octal @if ($loop->parent->first && $loop->first) highlight @endif">

        {{-- each month = days --}}

        <table class="b-0 ma text-center font-l">

          @foreach ($days as $day)

            {{-- (A) Here lie: 01 then 02 then .. --}}

            @if ($loop->first)

              {{-- Render Header --}}
              
              <!-- MONTH before days -->

              <div class="mb-2 text-center">
                <span class="font-l">{{ __($month) }}</span>
              
              </div>

              {{-- Mon Tue Wed .. --}}

              <tr>
                <th class="b-0">{{ __('Mon') }}</td>
                <th class="b-0">{{ __('Tue') }}</td>
                <th class="b-0">{{ __('Wed') }}</td>
                <th class="b-0">{{ __('Thu') }}</td>
                <th class="b-0">{{ __('Fri') }}</td>
              
              </tr>

              <tr> {{-- (D) I open first here --}}
              
              <?php
              
              // Offset Previous Month Days

              $weekDaysOffset; // define in this scope

              $date = (new \DateTime("$year-$month-$day"))->format("D"); // Mon
              $weekDaysOffset = \App\Helper\Extended\DateTime::whichDayOfWeek($date) - 1;

              ?>
            
            @endif

            <!-- New Line: new week -->

            @if (($loop->index + $weekDaysOffset) % 5 == 0)
              <!-- New Line Mon-Fri -->
              </tr> {{-- (D) and often close here --}}
              <tr>  {{-- (D) and often open here --}}

            @endif

              {{-- Days: w clickable links --}}
              
              @if ($loop->first)

                <!-- Offset Previous Month Days -->

                @for ( $i = 0; $i < $weekDaysOffset; $i++)
                  {{-- $i = 0, 1, 2, (4) // Mon, Tue, Wed, (Thu) --}}
                  <td class="b-0"></td>

                @endfor

              @endif

              <td class="b-0">
                {{--  count(timestamps) == count(links)
                      remember this
                --}}
                <a class="button button-route curvy-0"
                    href="{{ url($data['links'][$year][$month][$loop->index]) }}"
                    {{-- $loop->index => day --}}
                    >
                  <span>{{ $day }}</span>
                
                </a>
              
              </td>

            @if ($loop->last)
                </tr> {{-- (D) and finally close here --}}
            
            @endif

          @endforeach {{-- days --}}

        </table> {{-- each month = days --}}

      </div> {{-- position each table --}}

    @endforeach {{-- months --}}

  </div>

@endforeach {{-- years --}}