<?php

namespace App\Repositories\Admin\Experience;

use App\Models\ExperienceFile;
use Illuminate\Support\Facades\DB;

use Illuminate\Pagination\LengthAwarePaginator;
use Exception;
use Illuminate\Support\Facades\Auth;

use App\Models\Experience;
use App\Models\ExperienceAssociatedCategory;
use App\Models\ExperienceResidual;
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

  /**
   * @param int $paged
   * @param string $orderBy
   * @param string $sort
   *
   * @return mixed
   */
  public function getActivePaginated($paged = 15, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
  {
    return $this->model
      ->where('status', Experience::STATUS_ACTIVE)
      ->orderBy($orderBy, $sort)
      ->paginate($paged);
  }

  public function getActive($paged = 15, $orderBy = 'created_at', $sort = 'desc')
  {
    return  $this->model
      ->where('status', Experience::STATUS_ACTIVE)
      ->orderBy($orderBy, $sort)
      ->get();
  }


  /**
   * @param array $data
   *
   * @throws \Exception
   * @throws \Throwable
   * @return Experience
   */
  public function create(array $data): Experience
  {
    return DB::transaction(function () use ($data) {
      $experience = parent::create([
        'title' => $data['title'],
        'created_by' => Auth::user()->id,
        'place_id' => $data['place'],
        'price' => $data['price'],
        'type' => $data['type'],
        'duration' => $data['duration'],
        'latitude' => $data['latitude'],
        'longitude' => $data['longitude'],
        'short_description' => $data['short_description'],
        'status' => $data['status'],
        'priority_status' => $data['priority'],
      ]);
      if ($experience) {
        $experience->associatedCategory()->saveMany($this->syncCategories($data['categories']));
      }
      return $experience;



      throw new Exception(__('Error while creating experience'));
    });
  }


  /**
   * @param Experience  $place
   * @param array $data
   *
   * @throws Exception
   * @throws \Exception
   * @throws \Throwable
   * @return Experience
   */
  public function update(Experience $experience, array $data): Experience
  {

    return DB::transaction(function () use ($experience, $data) {
      $experience->update([
        'title' => $data['title'],
        'place_id' => $data['place'],
        'price' => $data['price'],
        'type' => $data['type'],
        'duration' => $data['duration'],
        'latitude' => $data['latitude'],
        'longitude' => $data['longitude'],
        'short_description' => $data['short_description'],
        'status' => $data['status'],
        'priority_status' => $data['priority'],
      ]);
      if ($experience) {
        $experience->associatedCategory()->delete();
        $experience->associatedCategory()->saveMany($this->syncCategories($data['categories']));
      }
      return $experience;
      throw new Exception(__('Error while updating experience'));
    });
  }



  /**
   * @param Experience $place
   *
   * @throws Exception
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

      throw new Exception(__('Error while deleting country place'));
    });
  }

  public function essentials(array $data, $id)
  {
    return DB::transaction(function () use ($data, $id) {


      return  ExperienceResidual::handleData($data, $id);


      throw new Exception(__('Error while deleting country place'));
    });
  }

  public function videos(array $data, $id)
  {
    return DB::transaction(function () use ($data, $id) {


      return  ExperienceResidual::handleVideoData($data, $id);


      throw new Exception(__('Error while deleting country place'));
    });
  }

  /**
   * Syncing new catgegory in experiece
   * @return array
   */

  private function syncCategories($data)
  {
    $categories = [];
    foreach ($data as $key => $value) {
      $categories[] = new ExperienceAssociatedCategory(['category_id' => $value]);
    }
    return $categories;
  }
  public function deleteExperience($id){
    $experienceDeleted = Experience::findorFail($id)->delete();
    ExperienceAssociatedCategory::where('experience_id',$id)->delete();
    ExperienceResidual::where('experience_id',$id)->delete();
    ExperienceFile::where('experience_id',$id)->delete();
    if($experienceDeleted){
      return true;
    }
    else{
      return false;
    }
  }
}
