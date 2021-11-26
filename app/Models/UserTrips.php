<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTrips extends Model
{
  public function tripCountry()
  {
    return $this->belongsTo(Country::class, 'starting_country_id');
  }
  public function tripPlaces()
  {
    return $this->hasMany(UserTripPlace::class, 'user_trip_id', 'id');
  }
  public function tripExperiences()
  {
    return $this->hasMany(UserTripExperience::class, 'user_trip_id', 'id');
  }
  public function tripProperties()
  {
    return $this->hasMany(UserTripProperty::class, 'user_trip_id', 'id');
  }
  public function tripUser(){
    return $this->belongsTo(User::class,'user_id','id');
  }

}
