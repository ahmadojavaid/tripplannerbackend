<?php

namespace App\Models\traits\attributes;

trait RouteAttribute
{

  public function getDepartureCountryNameAttribute()
  {
    return $this->routeDepartureCountry->name;
  }


  public function getDestinationCountryNameAttribute()
  {
    return $this->routeDestinationCountry->name;
  }

  public function getDestinationNameAttribute()
  {
    if ($this->destination_type ==  self::TYPE_PROPERTY)
      return $this->destinationProperty->title;
    else if ($this->destination_type ==  self::TYPE_EXPERIENCE)
      return $this->destinationExperience->title;
    else if ($this->destination_type == self::TYPE_CITY || $this->destination_type == self::TYPE_AIRPORT)
      return $this->destinationPlace->name;
  }

  public function getDepartureNameAttribute()
  {
    if ($this->departure_type ==  self::TYPE_PROPERTY)
      return $this->departureProperty->title;
    else if ($this->departure_type ==  self::TYPE_EXPERIENCE)
      return $this->departureExperience->title;
    else if ($this->departure_type == self::TYPE_CITY || $this->departure_type == self::TYPE_AIRPORT)
      return $this->departurePlace->name;
  }

  public function getSelectedDestinationAttribute()
  {
    if ($this->destination_type ==  self::TYPE_PROPERTY)
      return [
        'text' => $this->destinationProperty->title,
        'id' => $this->destinationProperty->id
      ];
    else if ($this->destination_type ==  self::TYPE_EXPERIENCE)
      return [
        'text' => $this->destinationExperience->title,
        'id' => $this->destinationExperience->id
      ];
    else if ($this->destination_type == self::TYPE_CITY || $this->destination_type == self::TYPE_AIRPORT)
      return [
        'text' => $this->destinationPlace->name,
        'id' => $this->destinationPlace->id
      ];
  }

  public function getSelectedDepartureAttribute()
  {
    if ($this->departure_type ==  self::TYPE_PROPERTY)
      return [
        'text' => $this->departureProperty->title,
        'id' => $this->departureProperty->id
      ];
    else if ($this->departure_type ==  self::TYPE_EXPERIENCE)
      return [
        'text' => $this->departureExperience->title,
        'id' => $this->departureExperience->id
      ];
    else if ($this->departure_type == self::TYPE_CITY || $this->departure_type == self::TYPE_AIRPORT) {
      return [
        'text' => $this->departurePlace->name,
        'id' => $this->departurePlace->id
      ];
    }
  }


  public function formCountryAttribute()
  {
    return $this->departure_country_id;
  }

  public function formDepartureCountryAttribute()
  {
    return $this->departure_country_id;
  }



  public function formDestinationCountryAttribute()
  {
    return $this->destination_country_id;
  }
}
