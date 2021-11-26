<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ArticleAssociatedCountry extends Model
{
  use SoftDeletes;
  public $timestamps = false;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'country_id', 'article_id'
  ];
  protected $dates = ['deleted_at'];

  public function country()
  {
    return $this->hasOne(Country::class, 'id', 'country_id');
  }
}
