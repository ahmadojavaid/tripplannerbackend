<?php

namespace App\Models\traits\methods;

use App\Models\ArticleAssociatedCountry;
use App\Models\ArticleAssociatedPlace;

trait UserArticleMethod
{

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

  public function getFile()
  {
    $files = \FileHelper::getFile($this->id, $this->photo, 'articles');
    if ($files)
      return $files;
    else
      return 'https://via.placeholder.com/300';
  }


  public function handleImagesUpload($data, $description)
  {
    // If images not empty
    $this->description = $description;

    if ($data) {
      $images = json_decode($data);

      foreach ($images as $index => $image) {

        $tempImage = str_replace('data:image/png;base64,', '', $image);
        $tempImage = str_replace(' ', '+', $tempImage);
        $temp = \FileHelper::getImageName($this->id . '/editor', 'png', 101 + $index, 'articles');
        \FileHelper::upload($temp['path'], base64_decode($tempImage));
        $description  = str_replace($image, \FileHelper::getFile($this->id . '/editor', $temp['name'], 'articles'), $description);
      }
      $this->description = $description;
    }
    $this->update();
  }



  public function getDirectory()
  {
    return  'articles';
  }



  /**
   * Syncing new tag in article tag
   * return array of tag to be stored in user tag article
   */
  public static function syncAssociatedCountries($data)
  {


    $countries = [];
    foreach ($data as $key => $value) {

      $countries[] = new ArticleAssociatedCountry(['country_id' => $value]);
    }
    return $countries;
  }

  /**
   * Syncing new tag in article tag
   * return array of tag to be stored in user tag article
   */
  public static function syncAssociatedPlaces($data)
  {
    $places = [];
    foreach ($data as $key => $value) {

      $places[] = new ArticleAssociatedPlace(['place_id' => $value]);
    }
    return $places;
  }
}
