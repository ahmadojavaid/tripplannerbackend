<?php

namespace App\Http\Requests\Admin\Trip;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTrip extends FormRequest
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
      'title' => 'required|string|max:100|unique:trips',
      'description' => 'required|string|max:1000',
      'status' => 'required',
      'priority' => 'required',
      'category' => 'required',
      "country" => 'required',
      "startingPlace" => 'required',
      "endingPlace" => 'required',
      'price' => 'required|numeric',
      'photo' => 'required',
      // 'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'places' => 'required|array',

    ];
  }
}
