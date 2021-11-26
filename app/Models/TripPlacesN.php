<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripPlacesN extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  public function placeFiles()
  {
    return $this->hasMany(PlaceFile::class, 'place_id', 'place_id');
  }

}
