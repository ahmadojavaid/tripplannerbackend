<?php

namespace App\Models\traits\methods;

trait RouteMethod
{
  public static function getTransportation()
  {
    return [
      self::TRANSPORTATION_FLIGHT => "Flight",
      self::TRANSPORTATION_PRIVATE => "Private",
       self::TRANSPORTATION_SELF_DRIVE => "Self Drive",
       self::TRANSPORTATION_OWN_ARRANGE => "Own Arrange",
       self::TRANSPORTATION_Private_transportation_with_english_speaking_guide => "Private transportation with english speaking guide",
       self::TRANSPORTATION_Train => "Train",
       self::TRANSPORTATION_Bus => "Bus",
       self::TRANSPORTATION_Airport => "Airport",
      // self::TRANSPORTATION_PUBLIC => "Public"
    ];
  }

  public static function getType()
  {
    return [
      self::TYPE_CITY => "City",
      self::TYPE_PROPERTY => "Property",
      self::TYPE_EXPERIENCE => "Experience",
      self::TYPE_AIRPORT => "Airport"
    ];
  }


  public function translateType($type)
  {
    switch ($type) {
      case self::TYPE_PROPERTY:
        return 'Property';
      case self::TYPE_CITY:
        return 'City';
      case self::TYPE_EXPERIENCE:
        return 'Experinece';
      case self::TYPE_AIRPORT:
        return 'Airport';
      default:
        return 'n/a';
    }
  }
}
