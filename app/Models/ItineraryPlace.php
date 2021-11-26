<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class ItineraryPlace extends Model
{


  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    "itinerary_id",
    "place_id",
  ];
}
