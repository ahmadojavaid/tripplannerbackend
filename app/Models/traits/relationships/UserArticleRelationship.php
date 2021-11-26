<?php

namespace App\Models\traits\relationships;

use App\Models\ArticleAssociatedCountry;
use App\Models\ArticleAssociatedPlace;
use App\Models\Country;
use App\Models\CountryPlace;
use App\Models\User;
use App\Models\UserArticleTag;

trait UserArticleRelationship
{


  public function articleAssociatedCountries()
  {
    return $this->hasMany(ArticleAssociatedCountry::class, 'article_id', 'id');
  }

  public function articleAssociatedPlaces()
  {
    return $this->hasMany(ArticleAssociatedPlace::class, 'article_id', 'id');
  }

  public function activeAssociatedPlaces()
  {
    return $this->hasManyThrough(CountryPlace::class, ArticleAssociatedPlace::class, 'article_id', 'id', 'id', 'place_id')
      ->where('status', CountryPlace::STATUS_ACTIVE);
  }

  public function activeAssociatedCountries()
  {
    return $this->hasManyThrough(Country::class, ArticleAssociatedCountry::class, 'article_id', 'id', 'id', 'country_id')
      ->where('status', Country::STATUS_ACTIVE);
  }

  public function country()
  {
    return $this->hasOne(Country::class, 'id', 'country_id');
  }

  public function createdBy()
  {
    return $this->hasOne(User::class, 'id', 'created_by');
  }
}
