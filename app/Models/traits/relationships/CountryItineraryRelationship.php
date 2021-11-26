<?php

namespace App\Models\traits\relationships;

use App\Models\Country;
use App\Models\User;

trait CountryItineraryRelationship
{

  public function itineraryCountry()
  {
    return $this->hasOne(Country::class, 'id', 'country_id');
  }

  public function  itineraryUser()
  {
    return $this->hasOne(User::class, 'id', 'created_by');
  }
}
