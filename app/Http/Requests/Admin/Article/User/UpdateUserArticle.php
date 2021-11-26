<?php

namespace App\Http\Requests\Admin\Article\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserArticle extends FormRequest
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
      'title' => 'required|string|max:100|unique:user_articles,title,' . $this->article->id,
      'sub_title' => 'required|string|max:100',
      'country' => 'required',
      'description' => 'required|max:225',
      'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'associatedPlaces' => 'required',
      'associatedCountries' => 'required',
      'reading_time' => 'required|string|max:20',
    ];


    //For blog user handling
    //worked only in admin case
    if (request()->has('status') &&  request()->has('priority_status')) {
      $validation['status'] = 'required';
      $validation['priority_status'] = 'required';
    }
  }
}
