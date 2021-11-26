<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PlaceFile extends Model
{
  use SoftDeletes;
  public $timestamps = false;
  const TYPE_IMAGE = 1;


  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'place_id', 'name', 'type',
  ];
  protected $dates = ['deleted_at'];


  public function getFile()
  {
    $files = \FileHelper::getFile($this->place_id, $this->name, $this->getDirectory($this->place));
    if ($files)
      return $files;
    else {
      return 'https://via.placeholder.com/300';
    }
  }

  public function getDirectory($place)
  {
    return  'countries/' . $place->country_id . '/places';
  }


  public function place()
  {
    return $this->hasOne(CountryPlace::class, 'id', 'place_id');
  }
}
