<?php

namespace App\Http\Requests\Admin\Property;

use Illuminate\Foundation\Http\FormRequest;

class StoreProperty extends FormRequest
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
      'title' => 'required|string|max:100|unique:properties',
      'place' => 'required|string',
      'type' => 'required|string',
      'price' => 'required|numeric',
      'categories' => 'required|array',
      'type' => 'required|string',
      'status' => 'required|string',
      'priority' => 'required|string',
      'latitude' => 'required|numeric',
      'longitude' => 'required|numeric',
      'short_description' => 'required|string|max:1000',
    ];
  }
}
