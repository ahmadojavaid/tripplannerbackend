<?php

namespace App\Http\Requests\User\Enquire;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnquire extends FormRequest
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
      'range_1' => 'required_without_all:range_2,range_3,range_4|numeric',
      'range_2' => 'sometimes|numeric',
      'range_3' => 'sometimes|numeric',
      'range_4' => 'sometimes|numeric',


      // 'range_2' => 'required_without:range_1,range_3,range_4',
      // 'range_3' => 'required_without:range_1,range_4',
      // 'range_4' => 'required_without:range_1',
      'child' => 'required',
      'adult' => 'required',
      'description' => 'required',
      'first_name' => 'required',
      'email' => 'required|email',
      'phone_no' => 'required',
    ];
  }
}
