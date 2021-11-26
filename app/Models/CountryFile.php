<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CountryFile extends Model
{
  use SoftDeletes;
  public $timestamps = false;
  const TYPE_IMAGE = 1;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'country_id', 'name', 'type',
  ];

  public function getFile()
  {
    $files = \FileHelper::getFile($this->country_id, $this->name, 'countries');
    if ($files)
      return $files;
    else {

      return 'https://via.placeholder.com/300';
    }
  }
  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = ['deleted_at'];

}
