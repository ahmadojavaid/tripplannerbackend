<?php

namespace App\Models;

use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;

use App\Models\traits\attributes\UserArticleAttribute;
use App\Models\traits\methods\UserArticleMethod;
use App\Models\traits\miscellaneous\FileMiscellaneous;
use App\Models\traits\relationships\UserArticleRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserArticle extends Model
{

  use
    FormAccessible,
    FileMiscellaneous,
    UserArticleRelationship,
    UserArticleMethod,
    SoftDeletes,
    UserArticleAttribute;

  const PRIORITY_STATUS_NORMAL = 1, PRIORITY_STATUS_HIGHLIGHTED = 2;
  const STATUS_ACTIVE = 1, STATUS_IN_ACTIVE = 2;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'title',
    "slug",
    'sub_title',
    'description',
    'status',
    'priority_status',
    'created_by',
    'photo',
    'country_id',
    'reading_time'
  ];
  protected $dates = ['deleted_at'];
  public function scopeFilterCountry($query, $id)
  {
    if ($id != "-1")
      return $query->where(['country_id' => $id]);
    else
      return $query->where(['priority_status' => UserArticle::PRIORITY_STATUS_HIGHLIGHTED]);
  }
}
