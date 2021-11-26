<?php

namespace App\Repositories\Admin\Place;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\File;


use App\Models\PlaceFile;
use App\Repositories\BaseRepository;

/**
 * Class PlaceFileRepository.
 */
class PlaceFileRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return PlaceFile::class;
  }

  public function store($data, $place): PlaceFile
  {


    return DB::transaction(function () use ($data, $place) {
      $tempSingleImg = \FileHelper::getImageName($place->id, $data['file']->getClientOriginalExtension(), 0, $this->model->getDirectory($place));
      $file = $this->model->create([
        'place_id' => $place->id,
        'name' => $tempSingleImg['name'],
        'type' => PlaceFile::TYPE_IMAGE
      ]);
      \FileHelper::upload($tempSingleImg['path'], File::get($data['file']));
      return $file;
      throw new GeneralException(__('Error while storing File'));
    });
  }


  public function destroy($data, $place)
  {

    return DB::transaction(function () use ($data, $place) {
      $path = \FileHelper::generateImagePath($place->id, $data['name'], $this->model->getDirectory($place));
      \FileHelper::deleteFile($path);
      return $this->model->where(['place_id' => $place->id,  'name' => $data['name']])->delete();
      throw new GeneralException(__('Error while storing File'));
    });
  }


  public function upload($place)
  {
    $files = PlaceFile::where('place_id', $place->id)->get()->toArray();
    $arr = [];
    foreach ($files as $key => $value) {
      $arr[$key]['name'] = $value['name'];
      $arr[$key]['path'] = \FileHelper::getFile($place->id, $value['name'], $this->model->getDirectory($place));
      $arr[$key]['size'] = \FileHelper::getSize(\FileHelper::generateImagePath($place->id, $value['name'], $this->model->getDirectory($place)));
    }
    return $arr;
  }

  public function getDirectory($id)
  {
    return 'countries/' . $id . '/places';
  }
}
