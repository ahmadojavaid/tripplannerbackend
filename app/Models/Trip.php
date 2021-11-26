<?php

namespace App\Models;

use App\Models\traits\miscellaneous\FileMiscellaneous;
use App\Models\traits\miscellaneous\StatusMethod;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;




class Trip extends Model
{

  use FileMiscellaneous, FormAccessible, StatusMethod,SoftDeletes;
  const
    //status
    STATUS_ACTIVE = 1,
    STATUS_IN_ACTIVE = 2,

    //priority
    PRIORITY_STATUS_NORMAL = 1,
    PRIORITY_STATUS_HIGHLIGHTED = 2,

    // category
    CATEGORY_CLASSIC = 1,
    CATEGORY_OFF_BEATEN = 2;




  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'created_by',
    "country_id",
    'title',
    'slug',
    'price',
    'description',
    'photo',
    'route_map_photo',
    'start_date',
    'end_date',
    'category',
    'status',
    'priority_status'
  ];
  protected $dates = ['deleted_at'];
  public function tripCountry()
  {
    return $this->belongsTo(Country::class, 'country_id');
  }
  public function tripPlaces()
  {
    return $this->hasMany(TripPlacesN::class, 'trip_id', 'id');
  }
  public function tripExperiences()
  {
    return $this->hasMany(TripExperience::class, 'trip_id', 'id');
  }
  public function tripProperties()
  {
    return $this->hasMany(TripProperty::class, 'trip_id', 'id');
  }


  public function getDirectory()
  {
    return 'trips';
  }
  public function getRoutMapDirectory()
  {
    return 'trips/routemaps';
  }

  public function formPriorityAttribute()
  {
    return $this->priority_status;
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

  public function formPlacesAttribute()
  {
    return $this->countryPlaces->pluck('place_id')->toArray();
  }


  public function selectedRoutes()
  {
    return $this->countryPlaces->map(function ($q) {
      return [
        'text' => $q->place->name,
        'id' => $q->place->id
      ];
    });
    // })->slice(1, -1)->values();
  }

  public function getMiddleLocationsAttribute()
  {
    return $this->selectedRoutes()->slice(1, -1)->values();
  }

  public function getStartLocationAttribute()
  {
    return $this->selectedRoutes()->first();
  }

  public function getEndLocationAttribute()
  {
    return  $this->selectedRoutes()->last();
  }





  public function countryPlaces()
  {
    return $this->hasMany(TripPlace::class, 'trip_id', 'id');
  }


  /**
   * Syncing new tag in article tag
   * return array of tag to be stored in user tag article
   */
  public static function syncPlaces($data)
  {
    $places = [];
    foreach ($data as $key => $value) {
      $places[] = new TripPlace(['place_id' => $value]);
    }
    return $places;
  }



  public function getFile()
  {
    $files = \FileHelper::getFile($this->id, $this->photo, 'trips');
    if ($files)
      return $files;
    else
      return 'https://via.placeholder.com/300';
  }
  public function getRouteMapsFile()
  {
    $files = \FileHelper::getFile($this->id, $this->photo, 'trips/routemaps');
    if ($files)
      return $files;
    else
      return 'https://via.placeholder.com/300';
  }

  public function country()
  {
    return $this->hasOne(Country::class, 'id', 'country_id');
  }

  public function createdBy()
  {
    return $this->hasOne(User::class, 'id', 'created_by');
  }

  public function getFavouriteAttribute()
  {
    return FavouriteTrip::where(['user_id' => Auth::guard('web')->user()->id, 'trip_id' => $this->id])->exists();
  }

  public function getCountryNameAttribute()
  {
    return $this->country->name;
  }

  public static function getCategoryArr()
  {
    return [
      self::CATEGORY_CLASSIC => "Classic",
      self::CATEGORY_OFF_BEATEN => "Off Beaten"
    ];
  }


  public function getUserNameAttribute()
  {
    return $this->createdBy->name;
  }
}
