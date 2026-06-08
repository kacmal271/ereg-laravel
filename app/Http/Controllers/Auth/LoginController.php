<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */
  
  // LOGIN SCRIPT
  use AuthenticatesUsers;
  
  // Where to redirect users after login.
  protected string $redirectTo = '/home';
  
  //*****************************************************************************
  public function logout()
  {
    Auth::logout();

    return redirect('/');

  }

  //*****************************************************************************
  public function authenticate(Request $request)
  {
    /**
     * Handle an authentication attempt
     * 
     * Login User based on:
     * # id
     * # password
     */

    session()->flush();

    // VALIDATOR: Validation may fail
    $credentials = $request->validate([
      /**
       * $request filled <form> names-values
       * create keys-values
       */
      'id'        => ['required'],
      'password'  => ['required'],
        // input-password hashed AFTER validation

    ]);

    // make database query
    $isRemembered = $request->input('remember') == null ? false : true;
    // AUTHENTICATOR: Authentication may fail
    if (Auth::attempt($credentials, $isRemembered))
    {
      // Prevent session fixation
      //   https://en.wikipedia.org/wiki/Session_fixation
      $request->session()->regenerate();

      // PREVIOUS AND LAST LOG IN
      // convert Authenticable (but Authenticable extends User) to User
      $user = \App\Models\User::FindOrFail(auth()->user()->id);
      // previous = last
      $user->previousLogIn = $user->lastLogIn;
      // last = now
      $user->lastLogIn = (new \DateTime())->format('Y-m-d H:i:s');
      // update
        // overwrite lastLogIn in database
        $user->update();

      // to each role their own landing page
      return redirect('/');

    }

    return back()->withErrors([
      'failed' => __('auth.failed')
    ]);

  }
  
  //*****************************************************************************
  public function index()
  {
    return view('auth.login');

  }

  //*****************************************************************************
  // Create a new controller instance
  public function __construct()
  {
    $this->middleware('guest')->except('logout');

  }

}
