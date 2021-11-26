<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripProperty extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  public function propertyFiles()
  {
    return $this->hasMany(PropertyFile::class, 'property_id', 'property_id');
  }
}
