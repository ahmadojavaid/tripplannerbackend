<?php

namespace App\Http\Requests\Admin\Country;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItinerary extends FormRequest
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
      'title' => 'required|string|max:100|unique:country_itineraries,title,' . $this->itinerary->id,
      'country' => 'required|string',
      'description' => 'required|string|max:1000',
      'status' => 'required|string',
      'priority_status' => 'required|string',
      'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];
  }
}
