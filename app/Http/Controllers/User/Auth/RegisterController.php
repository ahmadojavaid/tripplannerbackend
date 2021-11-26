<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class RegisterController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

  use RegistersUsers;

  /**
   * Where to redirect users after registration.
   *
   * @var string
   */
  protected $redirectTo = '/login';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest');
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
    return Validator::make($data, [
      'first_name' => ['required', 'string', 'max:255'],
      'last_name' => ['required', 'string', 'max:255'],
      'phone_no' => ['required', 'string', 'max:20'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8'],
      // 'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\Models\User
   */
  protected function create(array $data)
  {
    $user =  User::create([
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'email' => $data['email'],
      'phone_no' => $data['phone_no'],
      'password' => Hash::make($data['password']),
    ]);

    if ($user) {
      User::$guard_name = "web";
      $user->assignRole('user');
      return $user;
    }
  }

  // Register
  public function showRegistrationForm()
  {
    $pageConfigs = [
      'bodyClass' => "bg-full-screen-image",
      'blankPage' => true
    ];

    return view('pages.user.auth.register', [
      'pageConfigs' => $pageConfigs
    ]);
  }

  /**
   * Handle a registration request for the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function register(Request $request)
  {

    $validator =  $this->validator($request->all());
    if ($validator->fails()) {
      return  response()->json(
        $validator->errors(),
        422
      );
    }

    event(new Registered($user = $this->create($request->all())));
    if ($response = $this->registered($request, $user)) {
      return $response;
    }

    $this->guard('web')->login($user);

    return $request->wantsJson()
      ? new Response('', 204)
      : redirect($this->redirectTo);
  }
}
