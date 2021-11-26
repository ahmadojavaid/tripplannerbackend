<?php

namespace App\Models\traits\relationships;

use App\Models\Country;
use App\Models\CountryPlace;
use App\Models\Experience;
use App\Models\Property;
use App\Models\Route;

trait RouteRelationship
{

  public function routeDepartureCountry()
  {
    return $this->hasOne(Country::class, 'id', 'departure_country_id');
  }

  public function routeDestinationCountry()
  {
    return $this->hasOne(Country::class, 'id', 'destination_country_id');
  }

  public function destinationProperty()
  {
    return $this->hasOne(Property::class, 'id', 'destination_id');
  }

  public function destinationExperience()
  {
    return $this->hasOne(Experience::class, 'id', 'destination_id');
  }

  public function destinationPlace()
  {
    return $this->hasOne(CountryPlace::class, 'id', 'destination_id');
  }

  public function departureProperty()
  {
    return $this->hasOne(Property::class, 'id', 'departure_id');
  }

  public function departureExperience()
  {
    return $this->hasOne(Experience::class, 'id', 'departure_id');
  }

  public function departurePlace()
  {
    return $this->hasOne(CountryPlace::class, 'id', 'departure_id');
  }

  public function flightRoute()
  {
    return  $this->hasOne(Route::class, 'destination_country_id', 'destination_country_id')
      ->where('transport_type', Route::TRANSPORTATION_FLIGHT);
//    return $this->hasOne(Route::class, 'destination_country_id', 'destination_country_id')
//      ->where('transport_type', '==',Route::TRANSPORTATION_FLIGHT);
  }

  public function privateRoute()
  {
    return $this->hasOne(Route::class, 'destination_country_id', 'destination_country_id')
      ->where('transport_type',  Route::TRANSPORTATION_PRIVATE);
  }
  public function selfDriveRoute()
  {
    return $this->hasOne(Route::class, 'destination_country_id', 'destination_country_id')
      ->where('transport_type',  Route::TRANSPORTATION_SELF_DRIVE);
  }
  public function ownArrangeRoute()
  {
    return $this->hasOne(Route::class, 'destination_country_id', 'destination_country_id')
      ->where('transport_type', Route::TRANSPORTATION_OWN_ARRANGE);
  }
  public function privateWithEnglishRoute()
  {
    return $this->hasOne(Route::class, 'destination_country_id', 'destination_country_id')
      ->where('transport_type',  Route::TRANSPORTATION_Private_transportation_with_english_speaking_guide);
  }
  public function trainRoute()
  {
//    return $this->hasOne(CountryPlace::class, 'country_id', 'destination_country_id')
    return $this->hasOne(Route::class, 'destination_country_id', 'destination_country_id')
      ->where('transport_type', Route::TRANSPORTATION_Train);
  }
  public function busRoute()
  {
    return $this->hasOne(Route::class, 'destination_country_id', 'destination_country_id')
      ->where('transport_type',  Route::TRANSPORTATION_Bus);
  }
  public function airportRoute()
  {
    return $this->hasOne(Route::class, 'destination_country_id', 'destination_country_id')
      ->where('transport_type',  Route::TRANSPORTATION_Airport);
  }
}
