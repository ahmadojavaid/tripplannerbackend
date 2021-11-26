<?php

namespace App\Http\Requests\Admin\Experience;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryExperience extends FormRequest
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
      'name' => 'required|string|unique:experience_categories',
      'status' => 'required|string',
      'priority' => 'required|string',
    ];
  }
}
