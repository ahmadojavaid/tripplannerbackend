<?php

namespace App\Repositories\Admin\Property;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Models\Experience;
use App\Models\PropertyType;
use App\Repositories\BaseRepository;

/**
 * Class PropertyTypeRepository.
 */
class PropertyTypeRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return PropertyType::class;
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
      ->where('status', PropertyType::STATUS_ACTIVE)
      ->get();
  }


  /**
   * @param array $data
   *
   * @throws \Exception
   * @throws \Throwable
   * @return Experience
   */
  public function create(array $data): PropertyType
  {
    return DB::transaction(function () use ($data) {
      $type = parent::create([
        'name' => $data['name'],
        'status' => $data['status'],
        'priority_status' => $data['priority'],
      ]);
      return $type;
      throw new GeneralException(__('Error while creating property type'));
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
  public function update(PropertyType $type, array $data): PropertyType
  {

    return DB::transaction(function () use ($type, $data) {
      $type->update([
        'name' => $data['name'],
        'status' => $data['status'],
        'priority_status' => $data['priority'],
      ]);

      return $type;
      throw new GeneralException(__('Error while updating property type'));
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
  public function deletePropertyType($id){
    $propertyTypeDeleted = PropertyType::findorFail($id)->delete();
    if($propertyTypeDeleted){
      return true;
    }
    else{
      return false;
    }
  }
}
