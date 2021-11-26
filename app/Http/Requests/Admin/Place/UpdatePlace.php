<?php

namespace App\Http\Requests\Admin\Place;

use App\Models\CountryPlace;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePlace extends FormRequest
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
      'name' => 'required|string|max:100|unique:country_places,name,' . $this->place->id,
      'country' => 'required|string',
      'status' => 'required|string',
      'type' =>  ['required', Rule::unique('country_places')->where(function ($query) {
        return $query
          ->where(['type' => CountryPlace::TYPE_AIRPORT, 'short_code' => strtolower($this->short_code)])
          ->where('id', '!=', $this->place->id);
      })],
      'instagram_tag' => 'required|regex:/^[\w-]*$/',
      'priority' => 'required|string',
      'latitude' => 'required|numeric',
      'longitude' => 'required|numeric',
      'short_code' => 'required|string',
      'short_description' => 'required|string|max:1000'

    ];
  }

  /**
   * Get the validation messages that apply to the request.
   *
   * @return array
   */
  public function messages()
  {
    // use trans instead on Lang
    return [
      'type.unique' => "The type with given short code already code",
    ];
  }
}
