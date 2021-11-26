<?php

namespace App\Http\Requests\Admin\Property;

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
      // 'title' => 'required|string',
      'video-link' => 'required|string',
      // 'video-description' => 'required|string',
      // 'video-link-1' => 'required|string',
      // 'video-link-2' => 'required|string',
      // 'video-link-3' => 'required|string',
    ];
  }

  public function attributes()
  {
    return [
      'video-link' => 'video link'
      // 'video-description' => 'video description',
      // 'video-link-1' => 'video link 1',
      // 'video-link-2' => 'video link 2',
      // 'video-link-3' => 'video link 3',
    ];
  }
}
