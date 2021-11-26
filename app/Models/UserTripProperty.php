<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTripProperty extends Model
{
  public function propertyFiles()
  {
    return $this->hasMany(PropertyFile::class, 'property_id', 'property_id');
  }
}
