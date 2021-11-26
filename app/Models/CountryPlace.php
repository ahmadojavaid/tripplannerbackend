<?php

namespace App\Models;

use App\Models\traits\attributes\CountryPlaceAttribute;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;


use App\Models\traits\methods\CountryPlaceMethod;
use App\Models\traits\miscellaneous\FileMiscellaneous;
use App\Models\traits\miscellaneous\StatusMethod;
use App\Models\traits\relationships\CountryPlaceRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class CountryPlace extends Model
{
  use
    FileMiscellaneous,
    FormAccessible,
    CountryPlaceRelationship,
    CountryPlaceMethod,
    CountryPlaceAttribute,
    SoftDeletes,
    StatusMethod;

  const STATUS_ACTIVE = 1, STATUS_IN_ACTIVE = 2;
  const PRIORITY_STATUS_NORMAL = 1, PRIORITY_STATUS_HIGHLIGHTED = 2;
  const TYPE_CITY = 1, TYPE_AIRPORT = 2;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'country_id',
    'name',
    'slug',
    'photo',
    'status',
    'priority_status',
    'latitude',
    'longitude',
    'short_code',
    'short_description',
    'type',
    'instagram_tag'
  ];

  protected $appends = [
    'custom_id'
  ];
  protected $dates = ['deleted_at'];



  public static function getPlaceArr($id = 'id')
  {
    return CountryPlace::pluck('name', $id);
  }

  public static function getCityArr()
  {
    return CountryPlace::where('type', CountryPlace::TYPE_CITY)->get()->pluck('name', 'id');
  }

  public function  getCustomIdAttribute()
  {
    return $this->id . '-' . $this->short_code;
  }
}
