<?php

namespace App\Repositories\User\Country;

use App\Models\CountryPlace;
use App\Repositories\BaseRepository;


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

  public function place(array $data)
  {
    return $this->model
      ->with(['placeProperties', 'placeExperiences', 'activeArticles', 'essentials', 'videos'])
      ->where([
        'slug' => $data['slug'],
        'status' => CountryPlace::STATUS_ACTIVE,
        'type' => CountryPlace::TYPE_CITY
      ])
      ->firstOrFail();
  }


  public function list(array $data)
  {
    $countryPlaces = $this->model->where([
      'type' => CountryPlace::TYPE_CITY,
      'status' => CountryPlace::STATUS_ACTIVE
    ])
      ->with('placeFiles')
      ->has('placeFiles')
      ->has('airportPlace');
    if(!($data['id'] == '-1')){
      $countryPlaces->where(['country_id' => $data['id']]);
    }
    else{
      $countryPlaces->where(['priority_status' => CountryPlace::PRIORITY_STATUS_HIGHLIGHTED]);
    }
    return $countryPlaces->get();
  }

  public function  getPlaceById($id)
  {
    return $this->model
      ->with(['placeProperties', 'placeFiles', 'placeExperiences', 'essentials', 'videos'])
      ->has('placeFiles')
      ->where(['id' => $id, 'status' => CountryPlace::STATUS_ACTIVE])
      ->firstOrFail();
  }

  public function nearestAirport($latitude, $longitude, $countryId)
  {

    //need to implement logic for nearest airplace place
    return $this->model->where([
      'type' => CountryPlace::TYPE_AIRPORT,
      'country_id' => $countryId,
    ])->first();
  }

  /**
   * Trip Map locations with latittude and longitude
   */
  public function locations()
  {
    return $this->model->select('latitude', 'longitude', 'id')->where([
      'type' => CountryPlace::TYPE_CITY,
      'status' => CountryPlace::STATUS_ACTIVE,
      'priority_status' => CountryPlace::PRIORITY_STATUS_HIGHLIGHTED
    ])
      ->has('placeFiles')
      ->get()->map(function ($place) {
        return [
          $place->latitude,
          $place->longitude,
          2,
          $place->id,
          'place'
        ];
      });
  }


  public function locationPopup($data)
  {
    $location = $this->model->with('placeFiles')->where('id', $data['id'])->has('placeFiles')->first();
    return collect([
      'id' => $location->id,
      'name' => $location->name,
      "description" => $location->short_description,
      "image" => $location->placeFiles->first()->getFile()
    ]);
  }
  public function getPlaceLocationById($place_id){
    $countryPlaces = $this->model->select('latitude', 'longitude', 'id')->where([
      'type' => CountryPlace::TYPE_CITY,
      'status' => CountryPlace::STATUS_ACTIVE
    ])
      ->has('placeFiles');
    if(!($place_id['place_id'] == '-1')){
      $countryPlaces->where(['country_id' => $place_id['place_id']]);
    }
    else{
      $countryPlaces->where(['priority_status' => CountryPlace::PRIORITY_STATUS_HIGHLIGHTED]);
    }
    return $countryPlaces->get()->map(function ($place) {
      return [
        $place->latitude,
        $place->longitude,
        2,
        $place->id,
        'place'
      ];
    });
  }
}
