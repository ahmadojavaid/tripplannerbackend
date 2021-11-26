<?php

namespace App\Http\Requests\Admin\Route;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAirportRoute extends FormRequest
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
      'departure_country' => 'required|string',
      'destination_country' => 'required|string',
      'departure' => 'required|string',
      'destination' => 'required|string|not_in:' . $this->departure,
      'status' => 'required|string',
      'duration' => 'required|string|max:50',

    ];
  }
  /**
   * Get the validation messages that apply to the request.
   *
   * @return array
   */
  public function messages()
  {
    return [
      'destination.not_in' => "The destination and departure must be different",
    ];
  }
}
