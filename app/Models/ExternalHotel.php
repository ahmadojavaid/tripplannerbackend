<?php

namespace App\Models;

use App\Models\traits\miscellaneous\FileMiscellaneous;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class ExternalHotel extends Model
{
  use FileMiscellaneous;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'title', 'description', 'link', 'picture'
  ];

  public function getDirectory()
  {
    return "external-hotels";
  }


  public function getFile()
  {
    $files = \FileHelper::getFile($this->id, $this->picture, $this->getDirectory());
    if ($files)
      return $files;
    else
      return 'https://via.placeholder.com/300';
  }

  public function setTitleAttribute($value)
  {
    $this->attributes['title'] = $value;
    $this->attributes['slug'] = Str::slug($value);
  }
}
