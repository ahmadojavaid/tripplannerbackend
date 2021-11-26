<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class TripPlace extends Model
{

  public $timestamps = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    "trip_id",
    "place_id",
  ];


  public function place()
  {
    return $this->hasOne(CountryPlace::class, 'id', 'place_id');
  }
}
