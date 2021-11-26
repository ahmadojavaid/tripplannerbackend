<?php

namespace App\Models\traits\methods;

trait CountryPlaceMethod
{
  public function getFile()
  {
    $files = \FileHelper::getFile($this->id, $this->photo, $this->getDirectory());

    if ($files)
      return $files;
    else {

      return 'https://via.placeholder.com/300';
    }
  }

  public function getDirectory()
  {
    return  'countries/' . $this->country_id . '/places';
  }

  public static function getTypeArr()
  {
    return [
      self::TYPE_CITY => "City",
      self::TYPE_AIRPORT => "Airport"
    ];
  }

  public function translateType()
  {
    switch ($this->type) {
      case self::TYPE_CITY:
        return 'City';
      case self::TYPE_AIRPORT:
        return "Airport";
      default:
        return 'n/a';
    }
  }
}
