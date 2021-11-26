<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\traits\miscellaneous\StatusMethod;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class PropertyCategory extends Model
{

  public $timestamps = false;

  use
    FormAccessible,
    SoftDeletes,
    StatusMethod;

  const STATUS_ACTIVE = 1, STATUS_IN_ACTIVE = 2;
  const PRIORITY_STATUS_NORMAL = 1, PRIORITY_STATUS_HIGHLIGHTED = 2;


  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'slug',  'status', 'priority_status'
  ];
  protected $dates = ['deleted_at'];
  public function setNameAttribute($value)
  {
    $this->attributes['name'] = $value;
    $this->attributes['slug'] = Str::slug($value);
  }

  public function formPriorityAttribute()
  {
    return $this->priority_status;
  }

  public static function getCategoryArr()
  {
    return self::pluck('name', 'id');
  }
}
