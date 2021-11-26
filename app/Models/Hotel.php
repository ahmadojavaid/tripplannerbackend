<?php

namespace App\Models;

use App\Models\traits\methods\HotelMethod;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
  use FormAccessible, HotelMethod;
  const STATUS_ACTIVE = 1, STATUS_IN_ACTIVE = 2;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'place_id', 'name', 'slug', 'rooms', 'price', 'latitude', 'longitude',  'status', 'priority_status', 'short_description',
  ];
}
