<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin extends Middleware
{
  /**
   * Get the path the user should be redirected to when they are not authenticated.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return string
   */
  protected function redirectTo($request)
  {
    // if(Auth::guard('admin')->check())
    //   return route('admin.dashboard');

    if(!Auth::guard('admin')->user()){

      if (!$request->expectsJson()) {

        return route('admin.auth.show.login');
      }
    }

  }
}
