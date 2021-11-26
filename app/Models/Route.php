<?php

namespace App\Models;

use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;

use App\Models\traits\methods\RouteMethod;
use App\Models\traits\miscellaneous\StatusMethod;
use App\Models\traits\relationships\RouteRelationship;
use App\Models\traits\attributes\RouteAttribute;

class Route extends Model
{
  use FormAccessible,
    StatusMethod,
    RouteRelationship,
    RouteMethod,
    RouteAttribute;

  const
    //status
    STATUS_ACTIVE = 1,
    STATUS_IN_ACTIVE = 2,

    //transportation
    TRANSPORTATION_FLIGHT = 1,
    TRANSPORTATION_PRIVATE = 2,
    TRANSPORTATION_SELF_DRIVE = 3,
    TRANSPORTATION_OWN_ARRANGE = 4,
    TRANSPORTATION_Private_transportation_with_english_speaking_guide = 5,
    TRANSPORTATION_Train = 6,
    TRANSPORTATION_Bus = 7,
    TRANSPORTATION_Airport = 8,
//    TRANSPORTATION_PUBLIC = 5,

    //type
    TYPE_PROPERTY = 1,
    TYPE_EXPERIENCE = 2,
    TYPE_CITY = 3,
    TYPE_AIRPORT = 4;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'departure_country_id',
    'destination_country_id',
    'departure_id',
    'departure_type',
    'status',
    'destination_id',
    'destination_type',
    'transport_type',
    'duration',
    'price'
  ];
}
