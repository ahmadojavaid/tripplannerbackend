<?php

namespace App\Repositories\User\Country;

use App\Models\Experience;
use App\Repositories\BaseRepository;


/**
 * Class ExperienceRepository.
 */
class ExperienceRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return Experience::class;
  }


  public function experience(array $data)
  {
    return $this->model
      ->with(['essentials', 'videos', 'experienceFiles'])
      ->where(['slug' => $data['slug'], 'status' => Experience::STATUS_ACTIVE])
      ->firstOrFail();
  }

  public function  getExperienceById($id)
  {
    return $this->model
      ->with(['essentials', 'videos', 'experienceFiles'])
      ->where(['id' => $id, 'status' => Experience::STATUS_ACTIVE])
      ->firstOrFail();
  }
}
