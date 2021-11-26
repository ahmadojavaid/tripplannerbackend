<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PinnedArticle extends Model
{
  //
  public $timestamps = false;


  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id', 'article_id'
  ];

  public function scopeUserArticle($q, $articleId)
  {
    return $q->where(['user_id' => Auth::guard('web'), 'article_id' => $articleId]);
  }
}
