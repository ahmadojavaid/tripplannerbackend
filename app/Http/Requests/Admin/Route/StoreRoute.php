<?php

namespace App\Http\Requests\Admin\Route;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRoute extends FormRequest
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
