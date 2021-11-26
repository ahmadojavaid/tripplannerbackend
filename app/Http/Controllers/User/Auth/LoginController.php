<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;


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
  protected $redirectTo = '/';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest:web')->except('logout');
  }

  // Login
  public function showLoginForm()
  {

    $pageConfigs = [
      'bodyClass' => "bg-full-screen-image",
      'blankPage' => true
    ];
    return view('pages.user.auth.login', [
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
    $this->guard('web')->logout();

    // $request->session()->invalidate();

    return $this->loggedOut($request) ?: redirect('/');
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

    // $this->validateAjaxLogin($request);

    $validator = Validator::make($request->all(), [
      $this->username() => 'required|string',
      'password' => 'required|string',
    ]);
    if ($validator->fails()) {
      return  response()->json(
        $validator->errors(),
        422
      );
    }

    // $this->validateLogin($request);

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

    // return $this->sendFailedLoginResponse($request);
    return response()->json(
      [
        $this->username() => [trans('auth.failed')],
      ],
      422
    );
  }

  /**
   * Attempt to log the user into the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return bool
   */
  protected function attemptLogin(Request $request)
  {
    $credentialCheck = $this->guard('web')->attempt(
      $this->credentials($request),
      $request->filled('remember')
    );

    if ($credentialCheck) {
      $role = auth()->user()->hasRole('user');
      if ($role)
        return true;
      else
        auth()->guard('web')->logout();
    }

    return  false;
  }


  /**
   * Front is the guard for front.
   * @return mixed
   */
  protected function guard()
  {
    return auth()->guard('web');
  }
}
