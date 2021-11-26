<?php

namespace App\Repositories\Admin\Place;

use App\Models\PlaceFile;
use Illuminate\Support\Facades\DB;

use App\Models\CountryPlace;
use App\Models\PlaceResidual;
use App\Repositories\BaseRepository;
use Exception;

/**
 * Class PlaceRepository.
 */
class PlaceRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return CountryPlace::class;
  }


  /**
   * @param array $data
   *
   * @throws \Exception
   * @throws \Throwable
   * @return CountryPlace
   */
  public function create(array $data): CountryPlace
  {
    return DB::transaction(function () use ($data) {
      $place = parent::create([
        'name' => $data['name'],
        'country_id' => $data['country'],
        'short_code' => $data['short_code'],
        'latitude' => $data['latitude'],
        'longitude' => $data['longitude'],
        'short_description' => $data['short_description'],
        'status' => $data['status'],
        'type' => $data['type'],
        'instagram_tag' => $data['instagram_tag'],
        'priority_status' => $data['priority'],
      ]);
      return $place;
      throw new Exception(__('Error while creating country place'));
    });
  }


  /**
   * @param CountryPlace  $place
   * @param array $data
   *
   * @throws Exception
   * @throws \Exception
   * @throws \Throwable
   * @return CountryPlace
   */
  public function update(CountryPlace $place, array $data): CountryPlace
  {

    return DB::transaction(function () use ($place, $data) {
      $place->update([
        'name' => $data['name'],
        'country_id' => $data['country'],
        'short_code' => $data['short_code'],
        'latitude' => $data['latitude'],
        'longitude' => $data['longitude'],
        'short_description' => $data['short_description'],
        'status' => $data['status'],
        'type' => $data['type'],
        'instagram_tag' => $data['instagram_tag'],
        'priority_status' => $data['priority'],
      ]);

      return $place;
      throw new Exception(__('Error while updating country place'));
    });
  }



  public function essentials(array $data, $id)
  {
    return DB::transaction(function () use ($data, $id) {


      return  PlaceResidual::handleData($data, $id);


      throw new Exception(__('Error while deleting country place'));
    });
  }

  public function videos(array $data, $id)
  {
    return DB::transaction(function () use ($data, $id) {

      return  PlaceResidual::handleVideoData($data, $id);
      throw new Exception(__('Error while deleting country place'));
    });
  }

  public function placeArr()
  {
    return  $this->model->where(['status' => CountryPlace::STATUS_ACTIVE, 'type' => CountryPlace::TYPE_CITY])->get()->pluck('name', 'custom_id');
  }

  public function getPlaceId($customId)
  {

    return explode("-", $customId)[0];
  }

  public function getPlaceShortCode($customId)
  {
    return explode("-", $customId)[1];
  }
  /**
   * @param int $id
   * @return bool
   */
  public function deleteCountry(int $id){
    $placeDeleted = CountryPlace::findorFail($id)->delete();
    PlaceResidual::where('place_id',$id)->delete();
    PlaceFile::where('place_id',$id)->delete();
    if($placeDeleted){
      return true;
    }
    else{
      return false;
    }

  }
}
