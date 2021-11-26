<?php

namespace App\Http\Requests\Admin\Country;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideos extends FormRequest
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
      'description' => 'required|string|max:1000',
      'link_1' => 'required|string|max:200',
      'link_2' => 'required|string|max:200',
      'link_3' => 'required|string|max:200',
    ];
  }
}
