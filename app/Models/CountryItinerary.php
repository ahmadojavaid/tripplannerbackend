<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use App\Models\traits\attributes\CountryItineraryAttribute;
use App\Models\traits\methods\CountryItineraryMethod;
use App\Models\traits\relationships\CountryItineraryRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;
class CountryItinerary extends Model
{
  use FormAccessible,
    CountryItineraryRelationship,
    CountryItineraryMethod,
    SoftDeletes,
    CountryItineraryAttribute;
  const STATUS_ACTIVE = 1, STATUS_IN_ACTIVE = 2;
  const PRIORITY_STATUS_NORMAL = 1, PRIORITY_STATUS_HIGHLIGHTED = 2;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'country_id', 'created_by', 'title', 'slug', 'description', 'photo', 'status', 'priority_status', 'latitude', 'longitude',
  ];
  protected $dates = ['deleted_at'];
}
