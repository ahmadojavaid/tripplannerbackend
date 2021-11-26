<?php

namespace App\Models\traits\attributes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\PinnedArticle;

trait UserArticleAttribute
{
  public function getTagsAttribute()
  {
    return $this->userArticleTags->pluck('tag_id')->toArray();
  }

  public function getAssociatedCountriesAttribute()
  {
    return $this->articleAssociatedCountries->pluck('country_id')->toArray();
  }

  public function getAssociatedPlacesAttribute()
  {
    return $this->articleAssociatedPlaces->pluck('place_id')->toArray();
  }

  public function getCountryNameAttribute()
  {
    return $this->country->name;
  }

  public function getUserNameAttribute()
  {
    return $this->createdBy->name;
  }

  public function formCountryAttribute()
  {
    return $this->country_id;
  }


  public function setTitleAttribute($value)
  {
    $this->attributes['title'] = $value;
    $this->attributes['slug'] = Str::slug($value);
  }

  public function getPinnedAttribute()
  {
    return PinnedArticle::where(['user_id' => Auth::guard('web')->user()->id, 'article_id' => $this->id])->exists();
  }
}
