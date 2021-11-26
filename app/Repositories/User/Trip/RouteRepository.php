<?php

namespace App\Repositories\User\Trip;

use App\Models\Route;
use App\Repositories\BaseRepository;

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

  public function transport($id)
  {

    return $this->model->where('destination_id', $id)
      ->with('flightRoute', 'privateRoute','selfDriveRoute','ownArrangeRoute','privateWithEnglishRoute'
        ,'trainRoute','busRoute','airportRoute')
      ->first();
  }
}
