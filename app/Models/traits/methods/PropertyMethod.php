<?php

namespace App\Models\traits\methods;

trait PropertyMethod
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
    return  'countries/' . $this->propertyPlace->country_id . '/' . 'countries/' . $this->place_id . '/experiences';
  }
}
