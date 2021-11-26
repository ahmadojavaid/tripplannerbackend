<?php


namespace App\Repositories\User\Trip;
use App\Models\UserTrips;
use App\Repositories\BaseRepository;
/**
 * Class User Trip Repository
 */
class UserTripRepository
{
  /**
   * returns the model class
   * @return string
   */
  public function model(){
    return UserTrips::class;
  }

  /**
   * @param $id
   * @return mixed
   */
  public function getById($id,$place_id=0){
    $userTrip = UserTrips::with(['tripPlaces'=>function($q) use($place_id){
      $q->where('place_id',$place_id)->first();
    },'tripExperiences'=>function($qq) use($place_id){
      $qq->where('place_id',$place_id)->first();
    },'tripProperties'=>function($qqq) use($place_id){
      $qqq->where('place_id',$place_id)->first();
    }])->where('id',$id)->first();
    return $userTrip;
  }
}
