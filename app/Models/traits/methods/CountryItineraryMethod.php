<?php

namespace App\Models\traits\methods;

trait CountryItineraryMethod
{
  public static function getStatusArr()
  {
    return [
      self::STATUS_ACTIVE => "Active",
      self::STATUS_IN_ACTIVE => 'In active',
    ];
  }

  public function translateStatus()
  {
    switch ($this->status) {
      case self::STATUS_ACTIVE:
        return [
          'color' => 'badge badge-primary',
          'label' => 'Normal',
        ];
      case self::STATUS_IN_ACTIVE:
        return [
          'color' => 'badge badge-secondary',
          'label' => 'In active',
        ];
      default:
        return [
          'color' => 'badge badge-dark',
          'label' => 'N/A',
        ];
    }
  }

  public static function getPriorityStatusArr()
  {
    return [
      self::PRIORITY_STATUS_NORMAL => "Normal",
      self::PRIORITY_STATUS_HIGHLIGHTED => 'Highlighted',
    ];
  }

  public function translatePriorityStatus()
  {
    switch ($this->priority_status) {
      case self::PRIORITY_STATUS_NORMAL:
        return [
          'color' => 'badge badge-secondary',
          'label' => 'Normal',
        ];
      case self::PRIORITY_STATUS_HIGHLIGHTED:
        return [
          'color' => 'badge badge-primary',
          'label' => 'Highlighted',
        ];
      default:
        return [
          'color' => 'badge badge-dark',
          'label' => 'N/A',
        ];
    }
  }

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
    return  'countries/' . $this->country_id . '/itineraries';
  }
}
