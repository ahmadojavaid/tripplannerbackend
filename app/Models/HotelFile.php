<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelFile extends Model
{
  public $timestamps = false;
  const TYPE_IMAGE = 1;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'hotel_id', 'name', 'type',
  ];

  public function getFile()
  {
    $files = \FileHelper::getFile($this->hotel_id, $this->name, 'hotels');
    if ($files)
      return $files;
    else {
      return 'https://via.placeholder.com/300';
    }
  }
}
