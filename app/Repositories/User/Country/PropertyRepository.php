<?php

namespace App\Repositories\User\Country;

use App\Models\Property;
use App\Repositories\BaseRepository;


/**
 * Class PropertyRepository.
 */
class PropertyRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return Property::class;
  }


  public function property(array $data)
  {
    return $this->model
      ->with(['essentials', 'videos', 'propertyFiles'])
      ->where(['slug' => $data['slug'], 'status' => Property::STATUS_ACTIVE])
      ->first();
  }

  public function  getPropertyById($id)
  {
    return $this->model
      ->with(['essentials', 'videos', 'propertyFiles', 'propertyPlace'])
      ->where(['id' => $id, 'status' => Property::STATUS_ACTIVE])
      ->firstOrFail();
  }
}
