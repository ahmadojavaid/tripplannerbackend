<?php

namespace App\Http\Requests\Admin\Country;

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
      'when_to_go' => 'required|string',
      'weather' => 'required|string',
      'getting_there' => 'required|string',
      'travel_expenses' => 'required|string',
      'culture' => 'required|string',
    ];
  }
}
