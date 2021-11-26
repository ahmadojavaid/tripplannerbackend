<?php

namespace App\Models;

use App\Models\traits\miscellaneous\FileMiscellaneous;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

  use
    FileMiscellaneous;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'slug', 'value',
  ];


  public function getHowItWorkVideo()
  {
    $file = \FileHelper::getFile('how-it-work-video', $this->value, 'setting');
    if ($file)
      return $file;
    // else
    // return 'https://via.placeholder.com/300';
  }
}
