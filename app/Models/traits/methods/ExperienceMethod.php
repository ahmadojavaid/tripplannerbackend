<?php

namespace App\Models\traits\methods;

trait ExperienceMethod
{
  public function getFile()
  {
    $files = \FileHelper::getFile($this->id, $this->photo, $this->getDirectory());
    if ($files)
      return $files;
    else {

      return 'https://via.placeholder.com/300';
    }
  }

  public function getDirectory()
  {
    return  'countries/' . $this->experiencePlace->country_id . '/' . 'countries/' . $this->place_id . '/experiences';
  }

  public static function getTypeArr()
  {
    return [
      self::TYPE_PRIVATE => 'Private',
      self::TYPE_SHARED => "Shared"
    ];
  }
}
