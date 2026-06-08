<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * Table of Contents
 * # NOTIFICATION: EXPIRES ON DATETIME
 */

use App\Helper\ServerDatabaseConversion;
use App\Models\Notification;

// get: notification

$notifications = Notification::all();

$notificationsFiltered = [];

foreach ($notifications as & $notif)
{
  // NOTIFICATION: EXPIRES ON DATETIME
  $_now = date_create(date('Y-m-d h:i:s'));
  $then = date_create(date($notif->expires));
  if (date_diff($_now, $then)->format("%R%") == '+')
  { // not expired
    // '+' is now overshot
    $notif->notification = // notification w/ <br>
      ServerDatabaseConversion::markupNewlines($notif->notification);

    $notificationsFiltered[] = $notif;

  }

}

unset($notif); // clean-up reference

?>

<?php foreach ($notificationsFiltered as $notif) : ?>

  <div class="single notification mb-1"> 
    <strong>{{ $notif->title }}</strong>
    <span class="ml-1 bl-1 pl-1">{!! $notif->notification !!}</span>

  </div>

<?php endforeach; ?>