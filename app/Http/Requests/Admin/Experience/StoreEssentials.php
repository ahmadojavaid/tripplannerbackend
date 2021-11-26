<?php

namespace App\Http\Requests\Admin\Experience;

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
      'recommended-for' => 'sometimes|string|nullable',
      'why-this-experience' => 'sometimes|string|nullable',
      'what-you-can-expect' => 'sometimes|string|nullable',
      "what's-included" => 'sometimes|string|nullable',
      "what's-not-included" => 'sometimes|string|nullable',
    ];
  }


  public function attributes()
  {
    return [
      'recommended-for' => 'recommended for',
      'why-this-experience' => 'why this experience',
      'what-you-can-expect' => 'what you can expect',
      "wat's-included" => 'what\'s included',
      "wat's-not-included" => 'what\'s not included',
    ];
  }
}
