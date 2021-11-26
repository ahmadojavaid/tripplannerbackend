<?php

namespace App\Repositories\Admin\Trip;

use App\Models\Route;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\DB;
use App\Models\CountryPlace;
use App\Models\Experience;
use App\Models\Property;
use App\Repositories\BaseRepository;
use Exception;

/**
 * Class RouteRepository.
 */
class RouteRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return Route::class;
  }

  public function list()
  {
    return parent::with(
      'routeDepartureCountry',
      'departureProperty',
      'destinationProperty',
      'departureExperience',
      'destinationExperience',
      'departurePlace',
      'destinationPlace'
    )->get();
  }

  /**
   * @param array $data
   *
   * @throws \Exception
   * @throws \Throwable
   * @return Route
   */
  public function create(array $data): Route
  {
    return DB::transaction(function () use ($data) {
      $route = parent::create([
        'departure_country_id' => $data['country'],
        'departure_type' => $data['departure_type'],
        'departure_id' => $data['departure'],
        'destination_type' => $data['destination_type'],
        'destination_id' => $data['destination'],
        'transport_type' => $data['transport_type'],
        'status' => $data['status'],
        "destination_country_id" => $data["country"],
        'price' => $data['price'],
        'duration' => $data['duration']
      ]);
      if ($route)
        return $route;



      throw new Exception(__('Error while creating route'));
    });
  }

  /**
   * @param Route  $trip
   * @param array $data
   *
   * @throws GeneralException
   * @throws \Exception
   * @throws \Throwable
   * @return Route
   */
  public function update(Route $route, array $data): Route
  {
    return DB::transaction(function () use ($route, $data) {

      $route->update([
        'departure_country_id' => $data['country'],
        'departure_type' => $data['departure_type'],
        'departure_id' => $data['departure'],
        'destination_type' => $data['destination_type'],
        'destination_id' => $data['destination'],
        'transport_type' => $data['transport_type'],
        'status' => $data['status'],
        "detination_country_id" => $data["country"],
        'price' => $data['price'],
        'duration' => $data['duration'],
      ]);

      return $route;

      throw new Exception(__('Error while updating route'));
    });
  }


  public function locations(array $data)
  {

    if ($data['type'] == Route::TYPE_PROPERTY)
      $query = Property::select('title as text', 'id')
        ->whereHas('propertyPlace', function ($q) use ($data) {
          $q->where('country_id', $data['country']);
        });
    else if ($data['type'] == Route::TYPE_EXPERIENCE)
      $query = Experience::select('title as text', 'id', 'place_id')
        ->whereHas('experiencePlace', function ($q) use ($data) {
          $q->where('country_id', $data['country']);
        });
    else if ($data['type'] == Route::TYPE_CITY)
      $query = CountryPlace::select('name as text',  'id')->where([
        'country_id' => $data['country'],
        'type' => CountryPlace::TYPE_CITY
      ]);
    else if ($data['type'] == Route::TYPE_AIRPORT)
      $query = CountryPlace::select('name as text',  'id')->where([
        'country_id' => $data['country'],
        'type' => CountryPlace::TYPE_AIRPORT
      ]);


    return $query->get()->toArray();
  }

  public function storeAirport(array $data): Route
  {
    $route = parent::create([
      'departure_country_id' => $data['departure_country'],
      'departure_type' => Route::TYPE_AIRPORT,
      'departure_id' => $data['departure'],
      'destination_type' => Route::TYPE_AIRPORT,
      'destination_id' => $data['destination'],
      'transport_type' => Route::TRANSPORTATION_FLIGHT,
      'status' => $data['status'],
      "destination_country_id" => $data["destination_country"],
      'price' => $data['price'],
      'duration' => $data['duration'],
    ]);


    if ($route)
      return $route;

    throw new Exception(__('Error while creating route'));
  }

  public function updateAirport(Route $route, array $data): Route
  {
    return DB::transaction(function () use ($route, $data) {

      $route->update([
        'status' => $data['status'],
      ]);

      return $route;

      throw new Exception(__('Error while updating route'));
    });
  }
}
