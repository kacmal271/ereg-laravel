<?php

namespace App\Http\Controllers\Auth;

// reset password
use Illuminate\Auth\Events\PasswordReset;       // event
use Illuminate\Support\Str;                     // Laravel custom Str Class (string)
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Password Reset Controller
  |--------------------------------------------------------------------------
  |
  | This controller is responsible for handling password reset requests
  | and uses a simple trait to include this behavior. You're free to
  | explore this trait and override any methods you wish to tweak.
  |
  */
  
  use ResetsPasswords;
  
  /**
  * Where to redirect users after resetting their password.
  *
  * @var string
  */
  protected $redirectTo = '/home';
  
  //***************************************************************************
  public function index($token)
  {
    return view('auth.passwords.reset', [
      'token' => $token
    ]);

  }

  //***************************************************************************
  public function resetPassword(Request $request)
  {
    $request->validate([
      'token'     => 'required',
      'email'     => config('validator.email'),
      'password'  => array_merge(config('validator.password'), ['confirmed']),
    ]);

    $status = Password::reset(
      $request->only('email', 'password', 'password_confirmation', 'token'),
      function (User $user, string $password) {

        // force mass assignment: force fill even if $password shouldnt be
        // ( See: User::fillable )
        $user->forceFill([
          // generate random alphanum string of length=60
          'password' => Hash::make($password)
        ])->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

      } // anon function

    ); // Password::reset

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('auth.index')->with('status', __($status))
                : back()->withErrors(['email' => __($status)]);

  }

}
