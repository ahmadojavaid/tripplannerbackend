<?php

namespace App\Http\Requests\Admin\Country;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
// use Illuminate\Validation\ValidationException;

// use Illuminate\Contracts\Validation\Validator;

class StoreCountryFile extends FormRequest
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
      'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20000',
    ];
  }

  protected function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(response()->json($validator->errors(), 422));
  }
}
