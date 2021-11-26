<?php

namespace App\Http\Requests\Admin\Place;

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
      'why-to-go-there' => 'sometimes|string|nullable',
      'how-to-get-there' => 'sometimes|string|nullable',
      'how-to-fully-enjoy-it' => 'sometimes|string|nullable',
    ];
  }


  public function attributes()
  {
    return [
      'why-to-go-there' => 'why to go there',
      'how-to-get-there' => 'how to get there',
      'how-to-fully-enjoy-it' => 'how to fully enjoy it',
    ];
  }

  /**
   * Get the validation messages that apply to the request.
   *
   * @return array
   */
  // public function messages()
  // {
  //   // use trans instead on Lang
  //   return [
  //     'username.required' => Lang::get('userpasschange.usernamerequired'),
  //     'oldpassword.required' => Lang::get('userpasschange.oldpasswordrequired'),
  //     'oldpassword.max' => Lang::get('userpasschange.oldpasswordmax255'),
  //     'newpassword.required' => Lang::get('userpasschange.newpasswordrequired'),
  //     'newpassword.min' => Lang::get('userpasschange.newpasswordmin6'),
  //     'newpassword.max' => Lang::get('userpasschange.newpasswordmax255'),
  //     'newpassword.alpha_num' => Lang::get('userpasschange.newpasswordalpha_num'),
  //     'newpasswordagain.required' => Lang::get('userpasschange.newpasswordagainrequired'),
  //     'newpasswordagain.same:newpassword' => Lang::get('userpasschange.newpasswordagainsamenewpassword'),
  //     'username.max' => 'The :attribute field must  have under 255 chars',
  //   ];
  // }
}
