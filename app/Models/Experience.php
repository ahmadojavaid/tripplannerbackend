<?php

namespace App\Models;

use App\Models\traits\attributes\ExperienceAttribute;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;


use App\Models\traits\methods\ExperienceMethod;
use App\Models\traits\miscellaneous\FileMiscellaneous;
use App\Models\traits\miscellaneous\StatusMethod;
use App\Models\traits\relationships\ExperienceRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experience extends Model
{
  use
    FormAccessible,
    FileMiscellaneous,
    ExperienceMethod,
    ExperienceRelationship,
    ExperienceAttribute,
    SoftDeletes,
    StatusMethod;

  const STATUS_ACTIVE = 1, STATUS_IN_ACTIVE = 2;
  const PRIORITY_STATUS_NORMAL = 1, PRIORITY_STATUS_HIGHLIGHTED = 2;
  const TYPE_PRIVATE = 1, TYPE_SHARED = 2;


  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'created_by', 'title', 'slug', 'price', 'type', 'duration', 'status', 'short_description', 'priority_status', 'latitude',  'longitude', 'note', 'place_id',
  ];
  protected $dates = ['deleted_at'];
}
