<?php

namespace App\Models\traits\methods;

trait HotelMethod
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

  public static function getHotelArr()
  {
    return self::pluck('name', 'id');
  }
}
