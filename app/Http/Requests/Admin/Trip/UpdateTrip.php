<?php

namespace App\Http\Requests\Admin\Trip;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTrip extends FormRequest
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
      'title' => 'required|string|max:100|unique:trips,title,' . $this->trip->id,
      'description' => 'required|string|max:1000',
      'status' => 'required',
      'priority' => 'required',
      'category' => 'required',
      "country" => 'required',
      'price' => 'required|numeric',
      'photo' => 'sometimes|nullable|string',
      // 'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'places' => 'required',

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
