<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PropertyAssociatedCategory extends Model
{
 use SoftDeletes;
  public $timestamps = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'property_id', 'category_id'
  ];
  protected $dates = ['deleted_at'];
}
