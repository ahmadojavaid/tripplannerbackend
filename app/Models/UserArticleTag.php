<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class UserArticleTag extends Model
{
  public $timestamps = false;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'article_id', 'tag_id'
  ];

  public function tag()
  {
    return $this->hasOne(ArticleTag::class, 'id', 'tag_id');
  }
}
