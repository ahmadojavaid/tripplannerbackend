<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


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

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = '/admin';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    // $this->middleware(['guest:admin'])->except('logout');

    $this->middleware('guest:admin', ['except' => ['logout']]);
  }

  // Login
  public function showLoginForm()
  {

    $pageConfigs = [
      'bodyClass' => "bg-full-screen-image",
      'blankPage' => true
    ];
    return view('pages.admin.auth.login', [
      'pageConfigs' => $pageConfigs
    ]);
  }

  /**
   * Log the user out of the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function logout(Request $request)
  {
    $this->guard('admin')->logout();

    // $request->session()->invalidate();

    return $this->loggedOut($request) ?: redirect('/admin/login');
  }


  /**
   * Handle a login request to the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function login(Request $request)
  {
    $this->validateLogin($request);
    // If the class is using the ThrottlesLogins trait, we can automatically throttle
    // the login attempts for this application. We'll key this by the username and
    // the IP address of the client making these requests into this application.
    if (
      method_exists($this, 'hasTooManyLoginAttempts') &&
      $this->hasTooManyLoginAttempts($request)
    ) {
      $this->fireLockoutEvent($request);

      return $this->sendLockoutResponse($request);
    }

    if ($this->attemptLogin($request)) {
      return $this->sendLoginResponse($request);
    }

    // If the login attempt was unsuccessful we will increment the number of attempts
    // to login and redirect the user back to the login form. Of course, when this
    // user surpasses their maximum number of attempts they will get locked out.
    $this->incrementLoginAttempts($request);

    return $this->sendFailedLoginResponse($request);
  }



  /**
   * Attempt to log the user into the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return bool
   */
  protected function attemptLogin(Request $request)
  {
    $credentialCheck = $this->guard('admin')->attempt(
      $this->credentials($request),
      $request->filled('remember')
    );

    if ($credentialCheck) {
      $role = auth()->guard('admin')->user()->hasAnyRole('admin', 'blog user');
      if ($role)
        return true;
      else
        auth()->guard('admin')->logout();
    }
    return  false;
  }


  /**
   * Front is the guard for front.
   * @return mixed
   */
  protected function guard()
  {
    return auth()->guard('admin');
  }
}
