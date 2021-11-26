<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExperienceFile extends Model
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
    'experience_id', 'name', 'type',
  ];

  protected $dates = ['deleted_at'];
  public function getFile()
  {
    $files = \FileHelper::getFile($this->experience_id, $this->name, $this->getDirectory($this->experience));
    if ($files)
      return $files;
    else {

      return 'https://via.placeholder.com/300';
    }
  }

  public function getDirectory(Experience $experience)
  {
    return 'countries/' . $experience->experiencePlace->country_id . '/places/' . $experience->place_id . '/experiences/';
  }



  public function experience()
  {
    return $this->hasOne(Experience::class, 'id', 'experience_id');
  }

  // public function place()
  // {
  //   return $this->hasOne(CountryPlace::class, 'id', 'place_id');
  // }
}
