<?php

namespace App\Models\traits\attributes;


trait CountryItineraryAttribute
{

  public function getCountryAttribute()
  {
    return $this->itineraryCountry->name;
  }

  public function formCountryAttribute()
  {
    return $this->country_id;
  }

  public function getOwnerAttribute()
  {
    return $this->itineraryUser->name;
  }
}
