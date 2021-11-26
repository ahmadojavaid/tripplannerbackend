<?php

namespace App\Repositories\Admin\Experience;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Models\Experience;
use Illuminate\Support\Facades\File;


use App\Models\ExperienceFile;
use App\Repositories\BaseRepository;

/**
 * Class ExperienceRepository.
 */
class ExperienceFileRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return ExperienceFile::class;
  }

  public function store($data, $experience): ExperienceFile
  {

    return DB::transaction(function () use ($data, $experience) {
      $tempSingleImg = \FileHelper::getImageName($experience->id, $data['file']->getClientOriginalExtension(), 0, $this->model->getDirectory($experience));
      $file = $this->model->create([
        'experience_id' => $experience->id,
        'name' => $tempSingleImg['name'],
        'type' => ExperienceFile::TYPE_IMAGE
      ]);
      \FileHelper::upload($tempSingleImg['path'], File::get($data['file']));
      return $file;
      throw new GeneralException(__('Error while storing File'));
    });
  }


  public function destroy($data, $experience)
  {

    return DB::transaction(function () use ($data, $experience) {
      $path = \FileHelper::generateImagePath($experience->id, $data['name'], $this->model->getDirectory($experience));
      \FileHelper::deleteFile($path);
      return $this->model->where(['experience_id' => $experience->id,  'name' => $data['name']])->delete();
      throw new GeneralException(__('Error while storing File'));
    });
  }


  public function upload($experience)
  {
    $files = ExperienceFile::where('experience_id', $experience->id)->get()->toArray();
    $arr = [];
    foreach ($files as $key => $value) {
      $arr[$key]['name'] = $value['name'];
      $arr[$key]['path'] = \FileHelper::getFile($experience->id, $value['name'], $this->model->getDirectory($experience));
      $arr[$key]['size'] = \FileHelper::getSize(\FileHelper::generateImagePath($experience->id, $value['name'], $this->model->getDirectory($experience)));
    }
    return $arr;
  }
}
