<?php

namespace App\Http\Requests\User\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfile extends FormRequest
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
      'first_name' => 'required',
      'last_name' => 'required',
      'phone_no' => 'required',
      'email' => 'required|email|unique:users,email,' . $this->user->id,
      'password' => 'sometimes',
    ];
  }
}
