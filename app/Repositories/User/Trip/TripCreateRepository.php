<?php

namespace App\Repositories\User\Trip;

use App\Models\FavouriteTrip;
use App\Models\Trip;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class TripCreateRepository.
 */
class TripCreateRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return Trip::class;
  }


  public function getPaginatedTrip(array $data)
  {
    $query = Trip::where([
      'category' => $data['category'],
      'status' => Trip::STATUS_ACTIVE
    ]);

    if ($data['orderBy'] == "country")
      $query->with(['country' => function ($q) {
        return $q->orderBy('name');
      }]);
    else if ($data['orderBy'] == "price")
      $query->orderBy('price');

    return $query->paginate(15);
  }

  public function handleFavourite(array $data)
  {

    return DB::transaction(function () use ($data) {
      $trip = FavouriteTrip::where(['user_id' => Auth::guard('web')->user()->id, 'trip_id' => $data['id']])->first();
      if ($trip) {
        $trip = $trip->delete();
        $status = 'deleted';
      } else {
        $trip = FavouriteTrip::create(['user_id' => Auth::guard('web')->user()->id, 'trip_id' => $data['id']]);
        $status = 'favourite';
      }
      return $status;
      throw new Exception(__('Error while favourite process'));
    });
  }
}
