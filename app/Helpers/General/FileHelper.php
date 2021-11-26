<?php

namespace App\Helpers\General;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * Class FileHelper
 * @package App\Helpers\General
 */
class FileHelper
{
  /**
   * main directory path to store file data
   * CONST Root Directory
   */
  const ROOT_DIR = 'public/';

  /**
   * This function uploads/stores the file data into the storage/app directory
   * @param String $path
   * @param $content
   */
  public function upload(String $path, $content)
  {
    Storage::disk('local')->put($path, $content);
  }

  /**
   * this function checks whether there is any pre-existing data residing inside the folder already
   * @param String $path
   * @return bool
   */
  public function check(String $path)
  {
    return Storage::disk('local')->exists($path);
  }

  /**
   * this function creates the image name
   * and the path of the uploaded file as well.
   * @param $id
   * @param $extension
   * @param int $increment
   * @param string $dir
   * @return array
   */
  public function  getImageName($id, $extension, $increment = 1, $dir = '')
  {
    $name = Carbon::now()->addSeconds($increment)->timestamp . '.' . $extension;
    $path = self::ROOT_DIR . $dir . '/' . $id . '/' . $name;
    return [
      'name' => $name,
      'path' => $path
    ];
  }

  /**
   * Generating image path
   * @param $id
   * @param $name
   * @param $dir
   * @param bool $root
   * @return string
   */
  public function generateImagePath($id, $name, $dir, $root = false)
  {

    if ($root)
      return '/storage/' . $dir . '/' . $id . '/' . $name;
    return self::ROOT_DIR . $dir . '/' . $id . '/' . $name;
  }

  /**
   * generating path of the directory where the uploaded files are stored
   * @param $id
   * @param $dir
   * @return string
   */
  public function generateDirectoryPath($id, $dir)
  {
    return self::ROOT_DIR . $dir . '/' . $id;
  }

  /**
   * this function deletes the uploaded data from the server
   * @param $id
   * @param $files
   * @param $dir
   */
  public function deleteMultiple($id, $files, $dir)
  {
    if (!empty($files))
      foreach ($files as $key => $value) {
        $path = $this->getFile($id, $value, $dir);
        if ($path)
          $this->deleteFile($path);
      }
  }

  public function deleteFile($path)
  {
    Storage::disk('local')->delete($path);
  }

  public function deleteDirectory($directory)
  {
    //delete for working
    Storage::deleteDirectory($directory);
  }

  public function getFiles($files, $id, $dir)
  {
    $arr = [];
    if ($files)
      foreach ($files as $key => $value) {
        $path = $this->generateImagePath($id, $value, $dir);
        // $path = $this->getFile($id, $value, $dir);
        if ($path)
          array_push($arr, $path);
      }
    return $arr;
  }

  public function getFile($id, $name, $dir)
  {
    $path = $this->generateImagePath($id, $name, $dir);

    return $this->check($path) ? $this->generateImagePath($id, $name, $dir, true) : false;
  }

  public function getSize($path)
  {
    return Storage::disk('local')->size($path);
  }
}
