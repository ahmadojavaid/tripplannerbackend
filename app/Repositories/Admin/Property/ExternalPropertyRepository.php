<?php

namespace App\Repositories\Admin\Property;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Helpers\General\AmadeusHelper;
use App\Models\Property;
use App\Models\PropertyAssociatedCategory;
use App\Models\PropertyFile;
use App\Models\PropertyResidual;
use App\Repositories\Admin\Place\PlaceRepository;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Image;

/**
 * Class ExternalPropertyRepository.
 */
class ExternalPropertyRepository extends BaseRepository
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
    $hotel = (new AmadeusHelper)->getHotelDetail($data['external_id'])['data'];

    return DB::transaction(function () use ($data, $hotel) {
      $property = parent::create([
        'title' => $hotel['hotel']['name'],
        'created_by' => Auth::user()->id,
        'place_id' => (new PlaceRepository)->getPlaceId($data['city']),
        'type_id' => $data['type'],
        'price' => $hotel['offers'][0]['price']['total'] ?? "",
        'latitude' => $hotel['hotel']['latitude'] ?? "",
        'longitude' => $hotel['hotel']['longitude'] ?? "",
        'short_description' => $hotel['hotel']['description']['text'] ?? "",
        'created_by' => Auth::user()->id,
        'status' => $data['status'],
        'priority_status' => $data['priority'],
        'external_id' => $hotel['hotel']['hotelId'] ?? ""
      ]);

      $media = $hotel['hotel']['media'] ?? [];

      foreach ($media as $key => $value) {
        $tempSingleImg = \FileHelper::getImageName($property->id, 'jpeg', 0, (new PropertyFile())->getDirectory($property));
        $file = (new PropertyFile())->create([
          'property_id' => $property->id,
          'name' => $tempSingleImg['name'],
          'type' => PropertyFile::TYPE_IMAGE
        ]);


        $content = Image::make(file_get_contents($value['uri']))->resize(1200, 1600)->encode('jpg');
        \FileHelper::upload($tempSingleImg['path'], $content);
      }

      if ($property) {
        $property->associatedCategory()->saveMany($this->syncCategories($data['categories']));
      }
      return $property;



      throw new GeneralException(__('Error while creating Property'));
    });
  }


  /**
   * @param Property  $place
   * @param array $data
   *
   * @throws GeneralException
   * @throws \Exception
   * @throws \Throwable
   * @return Property
   */
  public function update(Property $Property, array $data): Property
  {

    return DB::transaction(function () use ($Property, $data) {
      $Property->update([
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
      if ($Property) {
        $Property->associatedCategory()->delete();
        $Property->associatedCategory()->saveMany($this->syncCategories($data['categories']));
      }
      return $Property;
      throw new GeneralException(__('Error while updating Property'));
    });
  }



  /**
   * @param Property $place
   *
   * @throws GeneralException
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

      throw new GeneralException(__('Error while deleting country place'));
    });
  }

  public function essentials(array $data, $id)
  {
    return DB::transaction(function () use ($data, $id) {


      return  PropertyResidual::handleData($data, $id);


      throw new GeneralException(__('Error while deleting country place'));
    });
  }

  public function videos(array $data, $id)
  {
    return DB::transaction(function () use ($data, $id) {
      return  PropertyResidual::handleVideoData($data, $id);
      throw new GeneralException(__('Error while deleting country place'));
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
}
