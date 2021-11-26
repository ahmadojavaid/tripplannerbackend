<?php

namespace App\Models;

use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;

use App\Models\traits\attributes\CountryAttribute;
use App\Models\traits\methods\CountryMethod;
use App\Models\traits\miscellaneous\StatusMethod;
use App\Models\traits\relationships\CountryRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;
class Country extends Model
{
  use FormAccessible,
    CountryRelationship,
    CountryAttribute,
    StatusMethod,
    CountryMethod,
   SoftDeletes;

  const STATUS_ACTIVE = 1, STATUS_IN_ACTIVE = 2;
  const PRIORITY_STATUS_NORMAL = 1, PRIORITY_STATUS_HIGHLIGHTED = 2;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'slug', 'short_description', 'status', 'priority_status', 'latitude', 'longitude'
  ];
  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = ['deleted_at'];
}
