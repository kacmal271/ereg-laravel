{{-- CONTROLLER --}}
{{-- CONTROLLER --}}
{{-- CONTROLLER --}}

{{-- VIEW --}}
{{-- VIEW --}}
{{-- VIEW --}}

<form action="{{ $route }}"
      method="get">
  <!-- searchbox -->
  <div class="focused-spotlight w-100 button-search-parent curvy-round">
    <button class="button button-search-button"></button>
    <input class="button-search-input"
            name="search"
            value="{{ $search ?? '' }}"
            autocomplete="off" />

  </div> <!-- /searchbox -->

</form>