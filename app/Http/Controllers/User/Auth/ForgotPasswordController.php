<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

  use SendsPasswordResetEmails;

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
   * Get the response for a successful password reset link.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  string  $response
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
   */
  protected function sendResetLinkResponse(Request $request, $response)
  {

    return  response()->json(
      [
        'message' => trans($response),
      ],
      200
    );
  }

  /**
   * Get the response for a failed password reset link.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  string  $response
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
   */
  protected function sendResetLinkFailedResponse(Request $request, $response)
  {

    return  response()->json(
      [
        'email' => [trans($response)],
      ],
      422
    );
  }

  // const PASSWORD_RESET = 'user.passwords.reset';


  /**
   * Send a reset link to the given user.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
   */
  public function sendResetLinkEmail(Request $request)
  {
    // $this->validateEmail($request);


    $validator = Validator::make($request->all(), [
      'email' => 'required|email'
    ]);
    if ($validator->fails()) {
      return  response()->json(
        $validator->errors(),
        422
      );
    }


    // We will send the password reset link to this user. Once we have attempted
    // to send the link, we will examine the response then see the message we
    // need to show to the user. Finally, we'll send out a proper response.
    $response = $this->broker()->sendResetLink(
      $this->credentials($request)
    );


    return $response == Password::RESET_LINK_SENT
      ? $this->sendResetLinkResponse($request, $response)
      : $this->sendResetLinkFailedResponse($request, $response);
  }
}
