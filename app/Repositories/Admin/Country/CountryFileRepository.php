<?php

namespace App\Repositories\Admin\Country;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\File;


use App\Models\CountryFile;
use App\Repositories\BaseRepository;

/**
 * Class CountryFileRepository.
 */
class CountryFileRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return CountryFile::class;
  }

  public function store($data, $id): CountryFile
  {

    return DB::transaction(function () use ($data, $id) {
      $tempSingleImg = \FileHelper::getImageName($id, $data['file']->getClientOriginalExtension(), 0, 'countries');
      $file = $this->model->create([
        'country_id' => $id,
        'name' => $tempSingleImg['name'],
        'type' => CountryFile::TYPE_IMAGE
      ]);
      \FileHelper::upload($tempSingleImg['path'], File::get($data['file']));
      return $file;
      throw new GeneralException(__('Error while storing File'));
    });
  }


  public function destroy($data, $id)
  {

    return DB::transaction(function () use ($data, $id) {
      $path = \FileHelper::generateImagePath($id, $data['name'], 'countries');
      \FileHelper::deleteFile($path);
      return $this->model->where(['country_id' => $id,  'name' => $data['name']])->delete();
      throw new GeneralException(__('Error while storing File'));
    });
  }


  public function upload($id)
  {
    $files = CountryFile::where('country_id', $id)->get()->toArray();
    $arr = [];
    foreach ($files as $key => $value) {
      $arr[$key]['name'] = $value['name'];
      $arr[$key]['path'] = \FileHelper::getFile($id, $value['name'], 'countries');
      $arr[$key]['size'] = \FileHelper::getSize(\FileHelper::generateImagePath($id, $value['name'], 'countries'));
    }
    return $arr;
  }
}
