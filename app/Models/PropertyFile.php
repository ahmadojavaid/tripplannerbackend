<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyFile extends Model
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
    'property_id', 'name', 'type',
  ];
  protected $dates = ['deleted_at'];

  public function getFile()
  {
    $files = \FileHelper::getFile($this->property_id, $this->name, $this->getDirectory($this->property));
    if ($files)
      return $files;
    else {

      return 'https://via.placeholder.com/300';
    }
  }

  public function getDirectory(Property $property)
  {
    return 'countries/' . $property->propertyPlace->country_id . '/places/' . $property->place_id . '/properties/';
  }



  public function property()
  {
    return $this->hasOne(Property::class, 'id', 'property_id');
  }
}
