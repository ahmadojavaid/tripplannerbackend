<?php

namespace App\Repositories\Admin\Property;

use App\Models\PropertyFile;
use Illuminate\Support\Facades\DB;
use App\Models\Property;
use App\Models\PropertyAssociatedCategory;
use App\Models\PropertyResidual;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

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


  public function getActive($paged = 15, $orderBy = 'created_at', $sort = 'desc')
  {
    return  $this->model
      ->where('status', Property::STATUS_ACTIVE)
      ->orderBy($orderBy, $sort)
      ->get();
  }


  /**
   * @param array $data
   *
   * @throws \Exception
   * @throws \Throwable
   * @return Property
   */
  public function create(array $data): Property
  {
    return DB::transaction(function () use ($data) {
      $property = parent::create([
        'title' => $data['title'],
        'created_by' => Auth::user()->id,
        'place_id' => $data['place'],
        'type_id' => $data['type'],
        'price' => $data['price'],
        'latitude' => $data['latitude'],
        'longitude' => $data['longitude'],
        'short_description' => $data['short_description'],
        'status' => $data['status'],
        'priority_status' => $data['priority'],
      ]);
      if ($property) {
        $property->associatedCategory()->saveMany($this->syncCategories($data['categories']));
      }
      return $property;



      throw new Exception(__('Error while creating Property'));
    });
  }


  /**
   * @param Property  $place
   * @param array $data
   *
   * @throws Exception
   * @throws \Exception
   * @throws \Throwable
   * @return Property
   */
  public function update(Property $property, array $data): Property
  {

    return DB::transaction(function () use ($property, $data) {
      $property->update([
        'title' => $data['title'],
        'place_id' => $data['place'],
        'price' => $data['price'],
        'type_id' => $data['type'],
        'latitude' => $data['latitude'],
        'longitude' => $data['longitude'],
        'short_description' => $data['short_description'],
        'status' => $data['status'],
        'priority_status' => $data['priority'],
      ]);
      if ($property) {
        $property->associatedCategory()->delete();
        $property->associatedCategory()->saveMany($this->syncCategories($data['categories']));
      }
      return $property;
      throw new Exception(__('Error while updating Property'));
    });
  }



  /**
   * @param Property $place
   *
   * @throws Exception
   * @throws \Exception
   * @throws \Throwable
   * @return Property
   */
  public function forceDelete(Property $place): Property
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


      return  PropertyResidual::handleData($data, $id);


      throw new Exception(__('Error while deleting country place'));
    });
  }

  public function videos(array $data, $id)
  {
    return DB::transaction(function () use ($data, $id) {
      return  PropertyResidual::handleVideoData($data, $id);
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
      $categories[] = new PropertyAssociatedCategory(['category_id' => $value]);
    }
    return $categories;
  }
  public function deleteProperty($id){
    PropertyResidual::where('property_id',$id)->delete();
    PropertyAssociatedCategory::where('property_id',$id)->delete();
    PropertyFile::where('property_id',$id)->delete();
    $propertyDeleted = Property::findorFail($id)->delete();
    if($propertyDeleted){
      return true;
    }
    else{
      return false;
    }
  }
}
