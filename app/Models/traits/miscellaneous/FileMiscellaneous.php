<?php

namespace App\Models\traits\miscellaneous;

use Illuminate\Support\Facades\File;

trait  FileMiscellaneous
{
  function storeFile($data, $id = 'id', $photo = 'photo', $increment = 1)
  {
    $temp = \FileHelper::getImageName($this->$id, $data->getClientOriginalExtension(), $increment, $this->getDirectory());
    $this->update([
      $photo => $temp['name']
    ]);
    \FileHelper::upload($temp['path'], File::get($data));
  }

  function updateFile($data, $id = 'id', $photo = 'photo', $increment = 1)
  {
    $tempPath = \FileHelper::generateImagePath($this->$id, $this->$photo, $this->getDirectory());
    \FileHelper::deleteFile($tempPath);
    $temp = \FileHelper::getImageName($this->$id, $data->getClientOriginalExtension(), $increment, $this->getDirectory());
    $this->update([
      $photo => $temp['name']
    ]);
    \FileHelper::upload($temp['path'], File::get($data));
  }


  function storeBase64File($data, $id = 'id', $photo = 'photo', $increment = 1)
  {
    //upload file
    $tempImage = str_replace('data:image/png;base64,', '', $data);
    $tempImage = str_replace(' ', '+', $tempImage);
    $temp = \FileHelper::getImageName($this->$id, 'png', 0, $this->getDirectory());
    \FileHelper::upload($temp['path'], base64_decode($tempImage));

    //store file
    $this->update([
      $photo => $temp['name']
    ]);
  }

  function storeBase64Filex($data, $id = 'id', $route_map_photo = 'route_map_photo', $increment = 1)
  {
    //upload file
    $tempImage = str_replace('data:image/png;base64,', '', $data);
    $tempImage = str_replace(' ', '+', $tempImage);
    $temp = \FileHelper::getImageName($this->$id, 'png', 0, $this->getRoutMapDirectory());
    \FileHelper::upload($temp['path'], base64_decode($tempImage));

    //store file
    $this->update([
      $route_map_photo => $temp['name']
    ]);
  }

  function updateBase64File($data, $id = 'id', $photo = 'photo', $increment = 1)
  {

    //delete file
    $tempPath = \FileHelper::generateImagePath($this->$id, $this->$photo, $this->getDirectory());
    \FileHelper::deleteFile($tempPath);

    //upload file
    $tempImage = str_replace('data:image/png;base64,', '', $data);
    $tempImage = str_replace(' ', '+', $tempImage);
    $temp = \FileHelper::getImageName($this->id, 'png', 0, $this->getDirectory());
    \FileHelper::upload($temp['path'], base64_decode($tempImage));

    //store file
    $this->update([
      $photo => $temp['name']
    ]);
  }
  function updateBase64Filex($data, $id = 'id', $route_map_photo = 'route_map_photo', $increment = 1)
  {
    //delete file
    $tempPath = \FileHelper::generateImagePath($this->$id, $this->$route_map_photo, $this->getRoutMapDirectory());
    \FileHelper::deleteFile($tempPath);

    //upload file
    $tempImage = str_replace('data:image/png;base64,', '', $data);
    $tempImage = str_replace(' ', '+', $tempImage);
    $temp = \FileHelper::getImageName($this->id, 'png', 0, $this->getRoutMapDirectory());
    \FileHelper::upload($temp['path'], base64_decode($tempImage));

    //store file
    $this->update([
      $route_map_photo => $temp['name']
    ]);
  }
}
