<?php

namespace App\Http\Controllers\User\Trip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Trip;
use App\Models\TripPlace;
use App\Repositories\User\Trip\TripRepository;

class TripController extends Controller
{
  protected $tripRepository;
  /**
   * TripController constructor.
   *
   * @param TripRepository $tripRepository
   */
  public function __construct(TripRepository $tripRepository)
  {
    $this->tripRepository = $tripRepository;
  }


  public function index()
  {
    return view('pages.user.trip.index', [
      'categoriesArr' => Trip::getCategoryArr()
    ]);
  }

  public function show($slug)
  {
    $usertrip = Trip::with([
      'tripExperiences'=>function($q){
        $q->with(['experienceFiles']);
      },
      'tripPlaces'=>function($q){
        $q->with(['placeFiles']);
      },
      'tripProperties'=>function($q){
        $q->with(['propertyFiles']);
      },
      'tripCountry' =>function($q){
        $q->with(['countryFile'=>function($qq){
          $qq->first();
        }]);
      }
    ])->find($slug);

    $date_diff = strtotime($usertrip->end_date) - strtotime($usertrip->start_date);

    $no_of_days = ( $date_diff/ (60 * 60 * 24));
    $places_count =   $usertrip->tripPlaces->count();
    $first_place = $usertrip->tripPlaces->first();
    $last_place = $usertrip->tripPlaces->last();

//    dump($no_of_days);
//    dump($places_count);
//    dump($first_place);
//    dump($last_place);
//return 123;
    return view('pages.user.trip.details', [
      'start_date' => date('d M, Y', strtotime($usertrip->start_date)) ,
      'end_date' => date('d M, Y', strtotime($usertrip->end_date)),
      'no_of_days' => $no_of_days,
      'places_count' => $places_count,
      'first_place' => $first_place,
      'last_place' => $last_place,
      'usertrip' => $usertrip,
      'data' => [
        'layout' => 'trip',
        'footer' => false
      ]
    ]);
//    $trip = Trip::with('countryPlaces.place')->where("slug", $slug)->first();
//
//    $tripPlaces = TripPlace::with('place')->where('trip_id', $trip->id)->get();
//    $locations = [];
//    foreach ($tripPlaces as $key => $value) {
//      $locations[] = [$value->place->latitude, $value->place->longitude];
//    }
//    return view('pages.user.trip.show', [
//      'categoriesArr' => Trip::getCategoryArr(),
//      'locations' => json_encode($locations),
//      'latitude' => $trip->country->latitude,
//      'longitude' => $trip->country->longitude,
//
//    ]);
  }


  public function list(Request $request)
  {
    $data = $this->tripRepository->getPaginatedTrip($request->all());
    return view('pages.user.trip.partials.list', compact('data'))->render();
  }


  public function handleFavourite(Request $request)
  {
    $status = $this->tripRepository->handleFavourite($request->all());
    return response()->json($status, 200);
  }
}
