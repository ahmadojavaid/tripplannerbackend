<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class CountryVideo extends Model
{
  use SoftDeletes;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'country_id', 'description', 'link_1', 'link_2', 'link_3'
  ];

  public function getType($url)
  {
    return Str::contains($url, 'vimeo') ? "vimeo" : "youtube";
  }
  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = ['deleted_at'];

}
