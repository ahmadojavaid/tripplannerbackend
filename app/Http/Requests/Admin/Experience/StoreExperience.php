<?php

namespace App\Http\Requests\Admin\Experience;

use Illuminate\Foundation\Http\FormRequest;

class StoreExperience extends FormRequest
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
      'title' => 'required|string|max:100|unique:experiences',
      'place' => 'required|string',
      'price' => 'required|numeric',
      'categories' => 'required|array',
      'type' => 'sometimes|string|nullable',
      'duration' => 'sometimes|string|max:20|nullable',
      'status' => 'required|string',
      'priority' => 'required|string',
      'latitude' => 'required|numeric',
      'longitude' => 'required|numeric',
      'short_description' => 'required|string|max:1000',
    ];
  }
}
