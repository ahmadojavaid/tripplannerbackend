<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTripExperience extends Model
{
  public function experienceFiles()
  {
    return $this->hasMany(ExperienceFile::class, 'experience_id', 'experience_id');
  }

}
