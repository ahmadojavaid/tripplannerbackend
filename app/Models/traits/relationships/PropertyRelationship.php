<?php

namespace App\Models\traits\relationships;

use App\Models\CountryPlace;
use App\Models\PropertyAssociatedCategory;
use App\Models\PropertyFile;
use App\Models\PropertyResidual;
use App\Models\User;

trait PropertyRelationship
{

  public function associatedCategory()
  {
    return $this->hasMany(PropertyAssociatedCategory::class, 'property_id', 'id');
  }

  public function propertyPlace()
  {
    return $this->hasOne(CountryPlace::class, 'id', 'place_id');
  }

  public function  poprertyUser()
  {
    return $this->hasOne(User::class, 'id', 'created_by');
  }

  public function propertyFiles()
  {
    return $this->hasMany(PropertyFile::class, 'property_id', 'id');
  }

  public function essentials()
  {
    return $this->hasMany(PropertyResidual::class, 'property_id', 'id')
      ->whereIn('slug', PropertyResidual::getFields());
  }

  public function videos()
  {
    return $this->hasMany(PropertyResidual::class, 'property_id', 'id')
      ->whereIn('slug', PropertyResidual::getVideoFields());
  }
}
