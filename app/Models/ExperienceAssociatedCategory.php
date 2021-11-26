<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ExperienceAssociatedCategory extends Model
{
 use SoftDeletes;
  public $timestamps = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'experience_id', 'category_id'
  ];
  protected $dates = ['deleted_at'];
}
