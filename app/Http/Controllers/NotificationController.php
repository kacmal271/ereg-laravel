<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

//-----------------------------------------------------------------------------
class NotificationController extends Controller
{

  //*****************************************************************************

  /**
   * Must but logged in
   * No need for: Protection Policies
   */
  
  public function __construct()
  {
    $this->middleware('auth');
    
  }
  
  //*****************************************************************************

  /**
   * Store Notification
   * Role: Admin
   */

  public function store(Request $request)
  {
    /**
     * Handle a notification request
     * 
     * Save in Database
     * # title
     * # message
     * # date
     * (# creation date) TRIGGER handling
     * (# update date) TRIGGER handling
     */

     $notificationData = $request->validate([
      'notificationTitle'   => ['required', ''],
      'notificationMessage' => ['required', ''],
      'notificationExpires' => ['required', 'date']

    ]);

    Notification::create([
      'title'         => $notificationData['notificationTitle'],
      'notification'  => $notificationData['notificationMessage'],
      'expires'       => $notificationData['notificationExpires']

    ])->save();

    return redirect()->route('notification.create');

  }

  //*****************************************************************************

  /**
   * Create Notification
   * Role: Admin
   */

  public function create()
  {
    $canCreate = auth()->user()->can('create', [Notification::class]);
    if ( ! $canCreate)
    {
      abort(abort(403));
    }

    return view('Access.Notification.create');

  }

}
