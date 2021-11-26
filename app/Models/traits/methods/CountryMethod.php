<?php

namespace App\Models\traits\methods;

use App\Models\Country;

trait CountryMethod
{
  public static function getCountryArr()
  {
    return Country::pluck('name', 'id');
  }
}
