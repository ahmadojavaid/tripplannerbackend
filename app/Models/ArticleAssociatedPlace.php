<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ArticleAssociatedPlace extends Model
{
  use SoftDeletes;
  public $timestamps = false;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'place_id', 'article_id',
  ];
  protected $dates = ['deleted_at'];

  public function place()
  {
    return $this->hasOne(CountryPlace::class, 'id', 'place_id');
  }

  public function article()
  {
    return $this->hasOne(UserArticle::class, 'id', 'article_id');
  }
}
