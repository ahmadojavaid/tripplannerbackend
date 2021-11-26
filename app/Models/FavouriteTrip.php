<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class FavouriteTrip extends Model
{


  public $timestamps = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    "trip_id",
    "user_id",
  ];
}
