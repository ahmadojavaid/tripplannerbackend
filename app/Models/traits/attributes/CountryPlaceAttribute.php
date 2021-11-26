<?php

namespace App\Models\traits\attributes;

use Illuminate\Support\Str;

trait CountryPlaceAttribute
{

  public function formCountryAttribute()
  {
    return $this->country_id;
  }

  public function getCountryNameAttribute()
  {
    return $this->placeCountry->name;
  }


  public function setNameAttribute($value)
  {
    $this->attributes['name'] = $value;
    $this->attributes['slug'] = Str::slug($value);
  }

  public function formPriorityAttribute()
  {
    return $this->priority_status;
  }
}
