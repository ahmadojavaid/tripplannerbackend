<?php

namespace App\Http\Requests\Admin\Property;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProperty extends FormRequest
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
      'title' => 'required|string|max:100|unique:properties,title,' . $this->property->id,
      'place' => 'required|string',
      'price' => 'required|numeric',
      'type' => 'required|string',
      'categories' => 'required|array',
      'status' => 'required|string',
      'priority' => 'required|string',
      'latitude' => 'required|numeric',
      'longitude' => 'required|numeric',
      'short_description' => 'required|string|1000',
    ];
  }
}
