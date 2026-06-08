{{-- CONTROLLER --}}
{{-- CONTROLLER --}}
{{-- CONTROLLER --}}

{{-- pass me: $status, $statusbarMessage --}}

@php
  
  // BiWork.css class
  $backgroundColor = 'background-transparent';

  switch ($status)
  {
    case 'status.ok' :
      // BiWork.css class
      $backgroundColor = 'background-ok';
      break;
      
    case 'status.warning' :
      // BiWork.css class
      $backgroundColor = 'background-warning';
      break;
      
    case 'status.error' :
      // BiWork.css class
      $backgroundColor = 'background-error';
      break;
      
  }
  
@endphp

{{-- VIEW --}}
{{-- VIEW --}}
{{-- VIEW --}}

<section  id="statusbar"
          class="{{ $backgroundColor }} vw-100 stick-to-bottom stick-to-left">
  <span class="block text-center">{{ $statusbarMessage }}</span>

</section>