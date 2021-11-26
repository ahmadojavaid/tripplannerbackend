<?php

namespace App\Models;

use App\Models\traits\attributes\PropertyAttribute;
use Illuminate\Database\Eloquent\Model;

use App\Models\traits\methods\PropertyMethod;
use App\Models\traits\miscellaneous\FileMiscellaneous;
use App\Models\traits\miscellaneous\StatusMethod;
use App\Models\traits\relationships\PropertyRelationship;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
  use
    FormAccessible,
    FileMiscellaneous,
    PropertyMethod,
    PropertyRelationship,
    SoftDeletes,
    PropertyAttribute,
    StatusMethod;

  const STATUS_ACTIVE = 1, STATUS_IN_ACTIVE = 2;
  const PRIORITY_STATUS_NORMAL = 1, PRIORITY_STATUS_HIGHLIGHTED = 2;


  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'created_by', 'title', 'slug', 'price', 'external_id', 'status', 'type_id', 'priority_status', 'latitude', 'short_description', 'longitude',  'place_id',
  ];
  protected $dates = ['deleted_at'];
}
