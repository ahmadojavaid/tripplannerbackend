<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class SocialAccount extends Model
{

  const PROVIDER_TYPE_GOOGLE = 1, PROVIDER_TYPE_FACEBOOK = 2;


  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    "provider_id",
    'provider_type',
    'token',
    'avatar',
  ];
}
