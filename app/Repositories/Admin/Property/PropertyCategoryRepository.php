<?php

namespace App\Repositories\Admin\Property;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Models\Experience;
use App\Models\PropertyCategory;
use App\Repositories\BaseRepository;

/**
 * Class PropertyCategoryRepository.
 */
class PropertyCategoryRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return PropertyCategory::class;
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
      ->where('status', PropertyCategory::STATUS_ACTIVE)
      ->get();
  }


  /**
   * @param array $data
   *
   * @throws \Exception
   * @throws \Throwable
   * @return Experience
   */
  public function create(array $data): PropertyCategory
  {
    return DB::transaction(function () use ($data) {
      $category = parent::create([
        'name' => $data['name'],
        'status' => $data['status'],
        'priority_status' => $data['priority'],
      ]);
      return $category;
      throw new GeneralException(__('Error while creating property category'));
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
  public function update(PropertyCategory $category, array $data): PropertyCategory
  {

    return DB::transaction(function () use ($category, $data) {
      $category->update([
        'name' => $data['name'],
        'status' => $data['status'],
        'priority_status' => $data['priority'],
      ]);

      return $category;
      throw new GeneralException(__('Error while updating property category'));
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
  public function deletePropertyCategory(int $id){
    $propertyCategoryDeleted = PropertyCategory::findorFail($id)->delete();
    if($propertyCategoryDeleted){
      return true;
    }
    else{
      return false;
    }
  }
}
