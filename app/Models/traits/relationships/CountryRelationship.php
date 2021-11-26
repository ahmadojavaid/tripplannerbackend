<?php

namespace App\Models\traits\relationships;

use App\Models\CountryEssential;
use App\Models\CountryFile;
use App\Models\CountryItinerary;
use App\Models\CountryPlace;
use App\Models\CountryVideo;
use App\Models\UserArticle;

trait CountryRelationship
{

  public function essential()
  {
    return $this->hasOne(CountryEssential::class, 'country_id', 'id')->withDefault();
  }

  public function countryFiles()
  {
    return $this->hasMany(CountryFile::class, 'country_id', 'id');
  }
  public function countryFile()
  {
    return $this->hasOne(CountryFile::class, 'country_id', 'id');
  }

  public function countryItineraries()
  {
    return $this->hasMany(CountryItinerary::class, 'country_id', 'id');
  }

  public function countryVideo()
  {
    return $this->hasOne(CountryVideo::class, 'country_id', 'id')->withDefault();
  }

  public function countryPlaces()
  {
    return $this->hasMany(CountryPlace::class, 'country_id', 'id');
  }

  public function countryCities()
  {
    return $this->hasMany(CountryPlace::class, 'country_id', 'id')
      ->where(['type' => CountryPlace::TYPE_CITY, 'status' => CountryPlace::STATUS_ACTIVE])
      ->has('placeFiles');
  }

  public function countryArticles()
  {
    return $this->hasMany(UserArticle::class, 'country_id', 'id');
  }

  public function activeArticles()
  {
    return $this->hasMany(UserArticle::class, 'country_id', 'id');
  }
}
