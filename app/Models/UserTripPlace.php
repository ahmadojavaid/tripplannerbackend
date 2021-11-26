<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTripPlace extends Model
{
  public function placeFiles()
  {
    return $this->hasMany(PlaceFile::class, 'place_id', 'place_id');
  }
}
