<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * This File - Goals:
 * # cooperate communication between PHP and JavaScript
 * # require PHP statusbar.blade.php
 * # require JS user-create-portraitPicture.js
 */

?>

{{-- JavaScript File API: error statusbar --}}
<input type="hidden"
        id="statusbar"
        value="@require('Snippet.statusbar', [
          $status => 'status.error',
          $statusbarMessage => __('The File APIs are not fully supported in this browser.')
        ])" />

{{-- JavaScript: here lie adding attachment logic --}}
<script type="text/javascript"
        src="{{ config('path.scripts.user') . "/user-create-portraitPicture.js" . '?v=' . time() }}"></script>