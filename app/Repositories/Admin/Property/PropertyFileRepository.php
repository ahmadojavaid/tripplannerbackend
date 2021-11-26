<?php

namespace App\Repositories\Admin\Property;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\File;


use App\Models\PropertyFile;
use App\Repositories\BaseRepository;

/**
 * Class ExperienceRepository.
 */
class PropertyFileRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return PropertyFile::class;
  }

  public function store($data, $property): PropertyFile
  {
    return DB::transaction(function () use ($data, $property) {

      $tempSingleImg = \FileHelper::getImageName($property->id, $data['file']->getClientOriginalExtension(), 0, $this->model->getDirectory($property));
      $file = $this->model->create([
        'property_id' => $property->id,
        'name' => $tempSingleImg['name'],
        'type' => PropertyFile::TYPE_IMAGE
      ]);
      \FileHelper::upload($tempSingleImg['path'], File::get($data['file']));
      return $file;
      throw new GeneralException(__('Error while storing File'));
    });
  }


  public function destroy($data, $property)
  {

    return DB::transaction(function () use ($data, $property) {
      $path = \FileHelper::generateImagePath($property->id, $data['name'], $this->model->getDirectory($property));
      \FileHelper::deleteFile($path);
      return $this->model->where(['property_id' => $property->id,  'name' => $data['name']])->delete();
      throw new GeneralException(__('Error while storing File'));
    });
  }


  public function upload($property)
  {
    $files = PropertyFile::where('property_id', $property->id)->get()->toArray();
    $arr = [];
    foreach ($files as $key => $value) {

      $arr[$key]['name'] = $value['name'];
      $arr[$key]['path'] = \FileHelper::getFile($property->id, $value['name'], $this->model->getDirectory($property));
      $arr[$key]['size'] = \FileHelper::getSize(\FileHelper::generateImagePath($property->id, $value['name'], $this->model->getDirectory($property)));
    }
    return $arr;
  }
}
