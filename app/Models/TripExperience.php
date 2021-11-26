<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripExperience extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  public function experienceFiles()
  {
    return $this->hasMany(ExperienceFile::class, 'experience_id', 'experience_id');
  }

}
