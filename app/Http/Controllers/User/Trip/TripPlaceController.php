<?php

namespace App\Http\Controllers\User\Trip;

use App\Http\Controllers\Controller;
use App\Repositories\User\Country\PlaceRepository;
use App\Repositories\User\Trip\RouteRepository;
use Illuminate\Http\Request;

class TripPlaceController extends Controller
{

  private
    $placeRepository, $routeRepository;

  /**
   * TripPlaceController constructor.
   *
   * @param PlaceRepository $placeRepository
   */
  public function __construct(PlaceRepository $placeRepository, RouteRepository $routeRepository)
  {
    $this->placeRepository = $placeRepository;
    $this->routeRepository = $routeRepository;
  }

  public function locatons()
  {
    return $this->placeRepository->locations();
  }

  public function popup(Request $request)
  {
    return $this->placeRepository->locationPopup($request->all());
  }

  public function add(Request $request)
  {
    $data =  $this->placeRepository->getPlaceById($request->only('id'));
    $this->savePlacesSessions($request->id,$data);
    return  view('pages.user.trip.partials.places.added', compact('data'))->render();
  }

  public function transport(Request $request)
  {
    $data =  $this->routeRepository->transport($request->id);
    return  view('pages.user.trip.partials.transport.modal_content',['place_id'=>$request->id], compact('data'))->render();
  }
  public function savePlacesSessions($place_id,$data){
    $places = session()->get('places');
    if(!$places) {

      $places = [
        $place_id => [
          "data" => $data,
        ]
      ];
      session()->put('places', $places);
    }else{
      $places[$place_id] = [
        "data" => $data,
      ];
      session()->put('places', $places);

    }

  }
  public function locationById(Request $request){
    return $this->placeRepository->getPlaceLocationById($request->only('place_id'));
  }
}
