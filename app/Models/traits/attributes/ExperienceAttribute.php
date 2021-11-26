<?php

namespace App\Models\traits\attributes;

use Illuminate\Support\Str;

trait ExperienceAttribute
{
  public function getPlaceNameAttribute()
  {
    return $this->experiencePlace->name;
  }

  public function formCountryAttribute()
  {
    return $this->palce_id;
  }

  public function getOwnerNameAttribute()
  {
    return $this->experienceUser->name;
  }


  public function setTitleAttribute($value)
  {
    $this->attributes['title'] = $value;
    $this->attributes['slug'] = Str::slug($value);
  }

  public function formPlaceAttribute()
  {
    return $this->place_id;
  }

  public function formCategoriesAttribute()
  {
    return $this->associatedCategory->pluck('category_id')->toArray();
  }

  public function formPriorityAttribute()
  {
    return $this->priority_status;
  }
}
