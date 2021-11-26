<?php

namespace App\Http\Requests\Admin\Country;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

// use Illuminate\Contracts\Validation\Validator;

class StoreCountryBasic extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name' => 'required|string|max:100|unique:countries',
      'short_description' => 'required|string|max:1000',
      'status' => 'required',
      'priority' => 'required',
      'latitude' => 'required|numeric',
      'longitude' => 'required|numeric',
    ];
  }
}
