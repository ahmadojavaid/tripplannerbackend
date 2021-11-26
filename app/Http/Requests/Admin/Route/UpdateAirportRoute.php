<?php

namespace App\Http\Requests\Admin\Route;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAirportRoute extends FormRequest
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
      'status' => 'required|string',
      'duration' => 'required|string|max:50',

    ];
  }
}
