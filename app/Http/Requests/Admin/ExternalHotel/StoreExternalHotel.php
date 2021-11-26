<?php

namespace App\Http\Requests\Admin\ExternalHotel;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
// use Illuminate\Validation\ValidationException;

class StoreExternalHotel extends FormRequest
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
      'title' => 'required|string|unique:external_hotels|max:100',
      // 'hotelTitle' => 'required|string|unique:external_hotels,title',
      'description' => 'required|string|max:255',
      'link' => 'required|string',
      'picture' => 'required',
    ];
  }

  protected function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(response()->json($validator->errors(), 422));
  }
}
