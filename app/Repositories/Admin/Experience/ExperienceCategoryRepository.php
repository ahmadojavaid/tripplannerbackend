<?php

namespace App\Repositories\Admin\Experience;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Models\Experience;
use App\Models\ExperienceCategory;
use App\Models\PlaceFile;
use App\Models\PlaceResidual;
use App\Repositories\BaseRepository;

/**
 * Class ExperienceCategoryRepository.
 */
class ExperienceCategoryRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return ExperienceCategory::class;
  }

  /**
   * @param int $paged
   * @param string $orderBy
   * @param string $sort
   *
   * @return mixed
   */
  public function activeList()
  {
    return $this->model
      ->where('status', ExperienceCategory::STATUS_ACTIVE)
      ->get();
  }


  /**
   * @param array $data
   *
   * @throws \Exception
   * @throws \Throwable
   * @return Experience
   */
  public function create(array $data): ExperienceCategory
  {
    return DB::transaction(function () use ($data) {
      $category = parent::create([
        'name' => $data['name'],
        'status' => $data['status'],
        'priority_status' => $data['priority'],
      ]);
      return $category;
      throw new GeneralException(__('Error while creating experience category'));
    });
  }


  /**
   * @param Experience  $place
   * @param array $data
   *
   * @throws GeneralException
   * @throws \Exception
   * @throws \Throwable
   * @return Experience
   */
  public function update(ExperienceCategory $category, array $data): ExperienceCategory
  {

    return DB::transaction(function () use ($category, $data) {
      $category->update([
        'name' => $data['name'],
        'status' => $data['status'],
        'priority_status' => $data['priority'],
      ]);

      return $category;
      throw new GeneralException(__('Error while updating experience category'));
    });
  }



  /**
   * @param Experience $place
   *
   * @throws GeneralException
   * @throws \Exception
   * @throws \Throwable
   * @return Experience
   */
  public function forceDelete(Experience $place): Experience
  {
    return DB::transaction(function () use ($place) {
      if ($place->delete()) {

        return $place;
      }

      throw new GeneralException(__('Error while deleting country place'));
    });
  }
  public function deleteExperience($id){
    $experienceCategoryDeleted = ExperienceCategory::findorFail($id)->delete();
    if($experienceCategoryDeleted){
      return true;
    }
    else{
      return false;
    }
  }
}
