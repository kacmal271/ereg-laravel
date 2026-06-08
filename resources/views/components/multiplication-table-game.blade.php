<div class="font-l flexbox flexbox-vertical flexbox-horizontal">

  <script src="{{ config('path.scripts.public') . '/Multiplication-table-game' . '/main.js?v=' . time() }}"
          type="module"></script>

  <!-- title -->
  <div  id="div-title"
        class="single">

    <h6>{{ __('Multiplication Table Game') }}</h6>

  </div> <!-- /title -->

  <!-- start-button -->
  <div id="div-start" class="hidden mt-04 ml-1 mr-1">

    <button class="button button-button background-green-binary b-1 border-white font-xs"
            type="button"
            id="div-start-button">
      {{ __('Start') }}</button>

  </div> <!-- /start-button -->

  <!-- pre-game-placeholder -->
  <div id="div-placeholder" class="hidden mt-04 ml-1 mr-1">

    <span class="font-gray">X × Y = </span>
    <input class="font-gray p-0 w-3 text-center border-gray" disabled />

  </div> <!-- /pre-game-placeholder -->

  <!-- inputs -->
  <div id="div-gameplay" class="hidden mt-04 ml-1 mr-1">

    <div class="inline-block mr-04">

      <span class="font-s font-time">{{ __('Time Left') }}&#x3A;</span>
      <span id="div-gameplay-timer" class="font-s font-time">??</span>

    </div>

    <div class="inline-block mr-04">

      <span id="div-gameplay-x" class="">?</span>
      <span id="div-gameplay-operator" class="">?</span>
      <span id="div-gameplay-y" class="">?</span>

      <!-- this flashes correct/wrong answer -->
      <input id="div-gameplay-user-answer" class="p-0 w-3 text-center border-white" />

      <button class="button button-button background-green-binary b-1 border-white font-xs"
              type="button"
              id="div-gameplay-button">
        {{ __('Confirm') }}</button>

    </div>

    <div class="inline-block">

      <span id="div-gameplay-progress-count" class="">#?</span>
      <span class="">{{ lcfirst(__('Of')) }}</span>
      <span id="div-gameplay-progress-max" class="">?</span>

    </div>

  </div> <!-- /inputs -->

  <!-- result -->
  <div id="div-result" class="hidden mt-04 ml-1 mr-1">

    <span>{{ __('Result') }}&#x3A;
      <span id="div-result-score-user">?</span>
      <span>{{ lcfirst(__('Of')) }}</span>
      <span id="div-result-score-max">?</span>
    </span>

  </div> <!-- /result -->
  
  <!-- Well begun is half done. - Aristotle -->

</div>