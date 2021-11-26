<?php

namespace App\Models\traits\relationships;

use App\Models\CountryPlace;
use App\Models\ExperienceAssociatedCategory;
use App\Models\ExperienceFile;
use App\Models\ExperienceResidual;
use App\Models\User;

trait ExperienceRelationship
{

  public function associatedCategory()
  {
    return $this->hasMany(ExperienceAssociatedCategory::class, 'experience_id', 'id');
  }

  public function experiencePlace()
  {
    return $this->hasOne(CountryPlace::class, 'id', 'place_id');
  }

  public function  experienceUser()
  {
    return $this->hasOne(User::class, 'id', 'created_by');
  }


  public function experienceFiles()
  {
    return $this->hasMany(ExperienceFile::class, 'experience_id', 'id');
  }

  public function essentials()
  {
    return $this->hasMany(ExperienceResidual::class, 'experience_id', 'id')
      ->whereIn('slug', ExperienceResidual::getFields());
  }

  public function videos()
  {
    return $this->hasMany(ExperienceResidual::class, 'experience_id', 'id')
      ->whereIn('slug', ExperienceResidual::getVideoFields());
  }
}
