<?php

namespace App\Http\Requests\Admin\Route;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRoute extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return Auth::guard('admin')->user()->isAdmin();;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'country' => 'required|string',
      'departure_type' => 'required|string',
      'departure' => 'required|string',
      'destination_type' => 'required|string',
      'destination' => 'required|string',
      'transport_type' => 'required|string',
      'status' => 'required|string',
      'price' => 'required|string',
      'duration' => 'required|string|max:50',

    ];
  }
}


//need to implement this later
// https://stackoverflow.com/questions/39042731/validate-a-base64-decoded-image-in-laravel/39442808

// Validator::extend('is_png',function($attribute, $value, $params, $validator) {
//   $image = base64_decode($value);
//   $f = finfo_open();
//   $result = finfo_buffer($f, $image, FILEINFO_MIME_TYPE);
//   return $result == 'image/png';
// });
