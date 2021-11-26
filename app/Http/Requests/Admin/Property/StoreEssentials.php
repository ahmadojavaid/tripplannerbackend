<?php

namespace App\Http\Requests\Admin\Property;

use Illuminate\Foundation\Http\FormRequest;

class StoreEssentials extends FormRequest
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
      'why-this-property-is-special' => 'sometimes|string|nullable',
      'rooms' => 'sometimes|string|nullable',
      'experiences' => 'sometimes|string|nullable',
      "cuisine" => 'sometimes|string|nullable',
      "what's-included" => 'sometimes|string|nullable',
    ];
  }



  public function attributes()
  {
    return [
      'why-this-property-is-special' => 'why this property is special',
      'rooms' => 'rooms',
      'experiences' => 'experiences',
      "cuisine" => 'cuisine',
      "what's-included" => 'what\'s included',
    ];
  }
}
