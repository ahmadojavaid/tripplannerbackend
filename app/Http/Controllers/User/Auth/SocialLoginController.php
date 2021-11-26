<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Repositories\User\Auth\SocialAccountRepository;
use Exception;
use Laravel\Socialite\Facades\Socialite;



class SocialLoginController extends Controller
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

  // use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = '/';


  protected  $socialAccountRepository;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(SocialAccountRepository $socialAccountRepository)
  {
    $this->middleware('guest:web');
    $this->socialAccountRepository = $socialAccountRepository;
  }


  public function facebookRedirect()
  {
    return Socialite::driver('facebook')->redirect();
  }

  public function facebookCallback()
  {

    try {
      $data = Socialite::driver('facebook')->fields(['first_name', 'last_name', 'email', 'id'])->user();
      $user = $data->user;
      $user = $this->socialAccountRepository->store(
        [
          'first_name' => $user['first_name'],
          'last_name' => $user['last_name'],
          'email' => $user['email'],
          'id' => $user['id'],
          'avatar' => $data->avatar,
          'token' => $data->token,
          'provider' => SocialAccount::PROVIDER_TYPE_FACEBOOK
        ]
      );
      $this->guard('web')->login($user);
    } catch (Exception $e) {
      throw new Exception("Login with facebook not work ,Try later");
    }
    return redirect('/');
  }

  public function googleRedirect()
  {

    return Socialite::driver('google')->redirect();
  }

  public function googleCallback()
  {


    try {
      $data = Socialite::driver('google')->user();
      $user = $data->user;
      $user = $this->socialAccountRepository->store(
        [
          'first_name' => $user['given_name'],
          'last_name' => $user['family_name'],
          'email' => $user['email'],
          'id' => $user['id'],
          'avatar' => $data->avatar,
          'token' => $data->token,
          'provider' => SocialAccount::PROVIDER_TYPE_GOOGLE
        ]
      );
      $this->guard('web')->login($user);
    } catch (\Exception $e) {
      throw new Exception("Loogi with Google not work ,Trry later");
    }
    return redirect('/');
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
