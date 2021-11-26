<?php

namespace App\Http\Requests\Admin\Property;

use Illuminate\Foundation\Http\FormRequest;

class StoreExternalProperty extends FormRequest
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
      'external_id' => 'required|string|unique:properties',
      'city' => 'required',
      'status' => 'required|string',
      'priority' => 'required|string',
      'type' => 'required',
      'categories' => 'required'
    ];
  }


  public function attributes()
  {
    return [
      'external_id' => 'hotel',
    ];
  }
}
