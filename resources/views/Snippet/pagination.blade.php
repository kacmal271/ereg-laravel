

<!-- pagination -->
<div class="flexbox flexbox-horizontal">

  <nav>

    <!-- horizontal-list -->
    <div class="navigation-horizontal">

      <!-- links -->

      @if (! $paginator->onFirstPage())

        <a href="{{ $paginator->url($paginator->firstPage) }}"
            class="button button-route navigation-horizontal-element">
          {{ __('pagination.First') }}
        </a>
    
        <a href="{{ $paginator->url($paginator->currentPage() - 1)}}"
            class="button button-route navigation-horizontal-element">
          {{ __('pagination.Prev') }}
        </a>

      @endif

      @php $onEachSide = config('mail.paginator.onEachSide') @endphp

      <!-- previous-pages -->

      @for ($i = $onEachSide; $i > 0; $i--)

        @php $pageNo = $paginator->currentPage() - $i @endphp

        @if ($pageNo >= 1)

          <a href="{{ $paginator->url($pageNo) }}"
              class="button button-route navigation-horizontal-element">
            {{ $pageNo }}
          </a>
        
        @endif

      @endfor

      <!-- /previous-pages -->

      <!-- current-page -->
      <a class="active button button-route navigation-horizontal-element"
          disabled>
        {{ $paginator->currentPage() }}
      </a> <!-- /current-page -->

      <!-- next-pages -->

      @for ($i = 1; $i <= $onEachSide; $i++)

        @php $pageNo = $paginator->currentPage() + $i @endphp

        @if ($pageNo <= $paginator->lastPage)

          <a href="{{ $paginator->url($pageNo) }}"
              class="button button-route navigation-horizontal-element">
            {{ $pageNo }}
          </a>

        @endif

      @endfor

      <!-- /next-pages -->

      @if ($paginator->currentPage() < $paginator->lastPage)
    
        <a href="{{ $paginator->url($paginator->currentPage() + 1) }}"
            class="button button-route navigation-horizontal-element">
          {{ __('pagination.Next') }}
        </a>
    
        <a href="{{ $paginator->url($paginator->lastPage) }}"
            class="button button-route navigation-horizontal-element">
          {{ __('pagination.Last') }}
        </a>

      @endif

      <!-- /links -->

    </div> <!-- /horizontal-list -->

  </nav>

</div> <!-- /pagination -->

