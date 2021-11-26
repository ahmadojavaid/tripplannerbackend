<?php

namespace App\Models\traits\relationships;

use App\Models\ArticleAssociatedPlace;
use App\Models\Country;
use App\Models\CountryPlace;
use App\Models\Experience;
use App\Models\PlaceFile;
use App\Models\PlaceResidual;
use App\Models\Property;
use App\Models\UserArticle;

trait CountryPlaceRelationship
{

  public function placeCountry()
  {
    return $this->hasOne(Country::class, 'id', 'country_id');
  }

  public function placeFiles()
  {
    return $this->hasMany(PlaceFile::class, 'place_id', 'id');
  }

  public function placeProperties()
  {
    return $this->hasMany(Property::class, 'place_id', 'id');
  }

  public function placeExperiences()
  {
    return $this->hasMany(Experience::class, 'place_id', 'id');
  }

  public function associatedArticles()
  {
    return $this->hasMany(ArticleAssociatedPlace::class, 'place_id', 'id');
  }

  public function activeArticles()
  {
    return $this->hasManyThrough(
      UserArticle::class,
      ArticleAssociatedPlace::class,
      'place_id',
      'id',
      'id',
      'article_id'
    )->where('status', UserArticle::STATUS_ACTIVE);
  }

  public function essentials()
  {
    return $this->hasMany(PlaceResidual::class, 'place_id', 'id')
      ->whereIn('slug', PlaceResidual::getFields());
  }

  public function videos()
  {
    return $this->hasMany(PlaceResidual::class, 'place_id', 'id')
      ->whereIn('slug', PlaceResidual::getVideoFields());
  }

  public function airportPlace()
  {
    return $this->belongsTo(CountryPlace::class, 'country_id', 'country_id')->where('type', CountryPlace::TYPE_AIRPORT);
  }
}
