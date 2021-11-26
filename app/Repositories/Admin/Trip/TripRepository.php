<?php

namespace App\Repositories\Admin\Trip;

use App\Models\Trip;
use App\Models\TripExperience;
use App\Models\TripPlacesN;
use App\Models\TripProperty;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


/**
 * Class TripRepository.
 */
class TripRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return Trip::class;
  }

  /**
   * @param array $data
   *
   * @throws \Exception
   * @throws \Throwable
   * @return Trip
   */
  public function create(array $data): Trip
  {
    return DB::transaction(function () use ($data) {
      array_push($data['places'], $data['endingPlace']);
      array_unshift($data['places'], $data['startingPlace']);

      $trip = parent::create([
        'title' => $data['title'],
        'start_date' => date('Y-m-d', strtotime($data['start_date'])) ,
        'end_date' => date('Y-m-d', strtotime($data['end_date'])) ,
        'slug' => Str::slug($data['title']),
        'description' => $data['description'],
        'status' => $data['status'],
        'priority_status' => $data['priority'],
        'category' => $data['category'],
        "country_id" => $data["country"],
        'price' => $data['price'],
        'created_by' => Auth::guard('admin')->user()->id,
        'photo' => 'temp',
        'route_map_photo' => 'temp',
      ]);

      if ($trip) {
        $trip->countryPlaces()->saveMany(Trip::syncPlaces($data['places']));
        $trip->storeBase64File($data['photo']);
        $trip->storeBase64Filex($data['route_map_photo']);
        return $trip;
      }

      throw new GeneralException(__('Error while creating trip'));
    });
  }

  /**
   * @param Trip  $trip
   * @param array $data
   *
   * @throws GeneralException
   * @throws \Exception
   * @throws \Throwable
   * @return Trip
   */
  public function update(Trip $trip, array $data): Trip
  {
    return DB::transaction(function () use ($trip, $data) {
      array_push($data['places'], $data['endingPlace']);
      array_unshift($data['places'], $data['startingPlace']);

      $trip->update([
        'title' => $data['title'],
        'slug' => Str::slug($data['title']),
        'description' => $data['description'],
        'status' => $data['status'],
        'priority_status' => $data['priority'],
        'category' => $data['category'],
        "country_id" => $data["country"],
        'price' => $data['price'],
      ]);



      $trip->countryPlaces()->delete();
      $trip->countryPlaces()->saveMany(Trip::syncPlaces($data['places']));

      if (isset($data['photo']))
        $trip->updateBase64File($data['photo']);

      if (isset($data['route_map_photo']))
      $trip->updateBase64Filex($data['route_map_photo']);

      return $trip;

      throw new GeneralException(__('Error while updating trip'));
    });
  }



  /**
   * @param Trip $trip
   *
   * @throws GeneralException
   * @throws \Exception
   * @throws \Throwable
   * @return Trip
   */
  public function forceDelete(Trip $trip): Trip
  {
    if ($trip->deleted_at === null) {
      throw new GeneralException(__('exceptions.backend.access.trips.delete_first'));
    }

    return DB::transaction(function () use ($trip) {
      // Delete associated relationships
      $trip->passwordHistories()->delete();
      $trip->providers()->delete();

      if ($trip->forceDelete()) {

        return $trip;
      }

      throw new GeneralException(__('exceptions.backend.access.trips.delete_error'));
    });
  }
  private function syncCategories($data)
  {
    $categories = [];
    foreach ($data as $key => $value) {
      $categories[] = new PropertyAssociatedCategory(['category_id' => $value]);
    }
    return $categories;
  }
  public function deleteTrip($id){
    TripProperty::where('trip_id',$id)->delete();
    TripPlacesN::where('trip_id',$id)->delete();
    TripExperience::where('trip_id',$id)->delete();
    $tripDeleted = Trip::findorFail($id)->delete();
    if($tripDeleted){
      return true;
    }
    else{
      return false;
    }
  }
}
