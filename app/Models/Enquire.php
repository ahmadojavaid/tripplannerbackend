<?php

namespace App\Models;

use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;

class Enquire extends Model
{
  use FormAccessible;

  const STATUS_IN_RPOCESS = 1, STATUS_COMPLETED = 2;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'adult_count', 'child_count', 'description', 'first_name', 'email', 'phone_no', 'range', 'status'
  ];

  public static function adultArr()
  {
    return [
      0 => "0 Adult",
      1 => "1 Adult",
      2 => "2 Adults",
      3 => "3 Adults",
      4 => "4 Adults",
      5 => "5 Adults",
    ];
  }


  public static function childArr()
  {
    return [
      0 => "0 Child",
      1 => "1 Child",
      2 => "2 Childs",
      3 => "3 Childs",
      4 => "4 Childs",
      5 => "5 Childs",
    ];
  }
}
