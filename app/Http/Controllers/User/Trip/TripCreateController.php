<?php

namespace App\Http\Controllers\User\Trip;

use App\Http\Controllers\Controller;
use App\Models\CountryPlace;
use App\Models\UserTripExperience;
use App\Models\UserTripPlace;
use App\Models\UserTripProperty;
use App\Models\UserTrips;
use Illuminate\Http\Request;

use App\Models\Trip;
use App\Models\TripPlace;
use App\Repositories\User\Country\CountryRepository;
use App\Repositories\User\Country\ExperienceRepository;
use App\Repositories\User\Country\PlaceRepository;
use App\Repositories\User\Country\PropertyRepository;
use App\Repositories\User\Trip\TripCreateRepository;
use Illuminate\Support\Facades\Auth;

class TripCreateController extends Controller
{

  private $tripCreateRepository,
    $countryRepository,
    $placeRepository,
    $propertyRepository,
    $experienceRepository;

  /**
   * TripCreationController constructor.
   *
   * @param TripCreateRepository $tripCreateRepository
   * @param CountryRepository $countryRepository
   * @param PlaceRepository $placeRepository
   * @param PropertyRepository  $propertyRepository
   * @param ExperienceRepository $experienceRepository
   */
  public function __construct(
    TripCreateRepository $tripCreateRepository,
    CountryRepository $countryRepository,
    PlaceRepository $placeRepository,
    PropertyRepository  $propertyRepository,
    ExperienceRepository $experienceRepository
  ) {
    $this->tripCreateRepository = $tripCreateRepository;
    $this->countryRepository = $countryRepository;
    $this->placeRepository = $placeRepository;
    $this->propertyRepository = $propertyRepository;
    $this->experienceRepository = $experienceRepository;
  }


  public function index()
  {
    if(session()->has('places') && session()->has('place_nights') && session()->has('startDate') && session()->has('endDate') && isset(Auth::user()->id))
    {
        $trip_title       =       session()->get('trip-title');
        $trip_description =       session()->get('trip-description');
        $startDate        =       session()->get('startDate');
        $endDate          =       session()->get('endDate');

        $startDate = date('Y-m-d', strtotime($startDate));
        $endDate = date('Y-m-d', strtotime($endDate));

        $userTrip = new UserTrips();
        $userTrip->title = isset($trip_title)?$trip_title:' ' ;
        $userTrip->description = isset($trip_description)?$trip_description:' ';
        $userTrip->slug = isset($trip_title)? implode('-', explode(' ',$trip_title)) :' ';
        $userTrip->user_id = Auth::user()->id;
        $userTrip->starting_country_id = 0;
        $userTrip->start_date = $startDate;
        $userTrip->end_date = $endDate;
        $userTrip->price = 0;
//        $userTrip->no_of_nights = 0;
        $userTrip->photo = 0;
        $userTrip->category = 0;
        $userTrip->status = 0;
        $userTrip->priority_status = 0;
        $userTrip->save();


        $places = session()->get('places');
        $nights = session()->get('place_nights');
        $country_id = 0;

        $total_trip_price = 0;

        foreach ($places as $key=>$place){
          $no_of_nights = 2;
          $transport_route_id = 0;
          $transport_price = 0;
          $transport_route_name = '';
          if(isset($nights[$key])){
            $night = $nights[$key];
            if(isset($night['nights'])){
              $no_of_nights = $night['nights'];
            }

            $place_transports = session()->get('place_transport');
            if(isset($place_transports[$key])){
              $place_transport = $place_transports[$key];
              if(isset($place_transport['data'])){
                $transport = $place_transport['data'];
                $transport_route_id = isset($transport[0]['transport_route_id'])?$transport[0]['transport_route_id']:0;
                $transport_price = isset($transport[0]['transport_price'])?$transport[0]['transport_price']:0;
                $transport_route_name = isset($transport[0]['transport_route_name'])?$transport[0]['transport_route_name']:'';
              }

            }

          }

          $placex = CountryPlace::find($key);
          $country_id = $placex->country_id;

          $tripPlaces = new UserTripPlace();

          $tripPlaces->place_id = $key;
          $tripPlaces->title = $placex->name;
          $tripPlaces->description = $placex->short_description;
          $tripPlaces->no_of_nights = $no_of_nights;

          $tripPlaces->user_trip_id = $userTrip->id ;
          $tripPlaces->transport_id = $transport_route_id;
          $tripPlaces->transport_title = $transport_route_name;
          $tripPlaces->transport_price = $transport_price;
          $tripPlaces->save();
          $total_trip_price = $total_trip_price+$transport_price;

        }

        if((session()->has('experiences'))){
          $experiences = session()->get('experiences');
          foreach($experiences as $key=>$experience){

            if(isset($experience['data'])){

              $userTripExperience = new UserTripExperience();
              $userTripExperience->title = $experience['data']->title;
              $userTripExperience->description = $experience['data']->short_description;

              $userTripExperience->user_trip_id = $userTrip->id;
              $userTripExperience->experience_id = $experience['data']->id;
              $userTripExperience->experience_price = $experience['data']->price;
              $userTripExperience->place_id = $experience['data']->place_id;
              $userTripExperience->save();

              $total_trip_price = $total_trip_price+$experience['data']->price;
            }

          }
        }

        if(session()->has('properties')){
          $properties = session()->get('properties');
          foreach($properties as $key=>$property){

            if(isset($property['data'])){

              $userTripProperty = new UserTripProperty();
              $userTripProperty->title = $property['data']->title;
              $userTripProperty->description = $property['data']->short_description;

              $userTripProperty->user_trip_id = $userTrip->id;
              $userTripProperty->property_id = $property['data']->id;
              $userTripProperty->place_id = $property['data']->place_id;
              $userTripProperty->property_price = $property['data']->price;
              $userTripProperty->save();

              $total_trip_price = $total_trip_price+$property['data']->price;
            }

          }
        }


        $userTrip->price = $total_trip_price;
        $userTrip->starting_country_id = $country_id;
        $userTrip->save();
      session()->forget(['places', 'properties','experiences','trip-title','trip-description','place_transport','place_nights']);
      return redirect()->route('user.my-trips');
    }
    return view('pages.user.trip.create.index', [
      'categoriesArr' => Trip::getCategoryArr(),
      'data' => [
        'layout' => 'trip',
        'footer' => false
      ]
    ]);
  }

  public function show($slug)
  {
    $trip = Trip::with('countryPlaces.place')->where("slug", $slug)->first();

    $tripPlaces = TripPlace::with('place')->where('trip_id', $trip->id)->get();
    $locations = [];
    foreach ($tripPlaces as $key => $value) {
      $locations[] = [$value->place->latitude, $value->place->longitude];
    }
    return view('pages.user.trip.show', [
      'categoriesArr' => Trip::getCategoryArr(),
      'locations' => json_encode($locations),
      'latitude' => $trip->country->latitude,
      'longitude' => $trip->country->longitude,
    ]);
  }


  public function list(Request $request)
  {
    $data = $this->tripCreateRepository->getPaginatedTrip($request->all());
    return view('pages.user.trip.partials.list', compact('data'))->render();
  }


  public function countryList()
  {
    $data =  $this->countryRepository->list();
    return  view('pages.user.trip.create.partials.country_list', compact('data'))->render();
  }


  public function placeList(Request $request)
  {
    $data =  $this->placeRepository->list($request->only('id'));
    return  view('pages.user.trip.create.partials.place_list', compact('data'))->render();
  }

  public function place(Request $request)
  {
//    return 112233;
    $data =  $this->placeRepository->getPlaceById($request->only('id'));
    $airport = $this->placeRepository->nearestAirport($data->latitude, $data->longitude, $data->country_id);
    return  view('pages.user.trip.partials.places.details', [
      'place' => $data,
      'essentials' => $data->essentials->pluck('value', 'slug'),
      'videos' =>  $data->videos->pluck('value', 'slug'),
      'airport' => $airport
    ])->render();
  }

  public function property(Request $request)
  {
    $data =  $this->propertyRepository->getPropertyById($request->only('id'));
    return  view('pages.user.trip.partials.properties.details',  [
      'property' => $data,
      'essentials' => $data->essentials->pluck('value', 'slug'),
      'videos' =>  $data->videos->pluck('value', 'slug'),
    ])->render();
  }

  public function experience(Request $request)
  {
    $data =  $this->experienceRepository->getExperienceById($request->only('id'));

    return  view('pages.user.trip.partials.experiences.details',  [
      'experience' => $data,
      'essentials' => $data->essentials->pluck('value', 'slug'),
      'videos' =>  $data->videos->pluck('value', 'slug'),
    ])->render();
  }


  public function addProperty(Request $request)
  {
    $data =  $this->propertyRepository->getPropertyById($request->only('id'));
    $this->savePropertiesSessions($request->id,$data);
    return  view('pages.user.trip.partials.properties.added', [
      'property' => $data,
      'essentials' => $data->essentials->pluck('value', 'slug'),
      'videos' =>  $data->videos->pluck('value', 'slug'),
    ])->render();
  }

  public function addExperience(Request $request)
  {
    $data =  $this->experienceRepository->getExperienceById($request->only('id'));
    $this->saveExperiencesSessions($request->id,$data);
    return  view('pages.user.trip.partials.experiences.added', [
      'experience' => $data,
      'essentials' => $data->essentials->pluck('value', 'slug'),
      'videos' =>  $data->videos->pluck('value', 'slug'),
    ])->render();
  }
  public function saveExperiencesSessions($experience_id,$data){
    $experiences = session()->get('experiences');
    if(!$experiences) {

      $experiences = [
        $experience_id => [
          "data" => $data,
        ]
      ];
      session()->put('experiences', $experiences);
    }else{
      $experiences[$experience_id] = [
        "data" => $data,
      ];
      session()->put('experiences', $experiences);

    }

  }
  public function savePropertiesSessions($property_id,$data){
    $properties = session()->get('properties');
    if(!$properties) {

      $properties = [
        $property_id => [
          "data" => $data,
        ]
      ];
      session()->put('properties', $properties);
    }else{
      $properties[$property_id] = [
        "data" => $data,
      ];
      session()->put('properties', $properties);
    }

  }

  public function addTripIntro(Request $request){
    $description = $request->description;
    $title = $request->title;
    session()->put('trip-title', $title);
    session()->put('trip-description', $description);

  }

  public function addTripTransport(Request $request){

    $place_transport = session()->get('place_transport');

    $data[] = [
      'transport_route_id'=>$request->route_id,
      'transport_price'=>$request->price,
      'transport_route_name'=>$request->route_name
    ];
    if(!$place_transport) {

      $transports_data = [
        $request->place_id => [
          "data" => $data,
        ]
      ];
      session()->put('place_transport', $transports_data);
    }else{
      $place_transport[$request->place_id] = [
        "data" => $data,
      ];
      session()->put('place_transport', $place_transport);

    }

  }

  public function addTripPlacesNights(Request $request){
//    return 112233;
     $startDate = $request->startDate;
    $endDate = $request->endDate;
    session()->put('startDate', $startDate);
    session()->put('endDate', $endDate);
    $place_nights = session()->get('place_nights');

    if(!$place_nights) {

      $nights_data = [
        $request->place_id => [
          "nights" => $request->nights,
        ]
      ];
      session()->put('place_nights', $nights_data);
    }else{
      $place_nights[$request->place_id] = [
        "nights" => $request->nights,
      ];
      session()->put('place_nights', $place_nights);
    }
  }
  public function updateTripIntro($id){
    if(session()->has('trip-title') && session()->has('trip-description')){
      $userTrip = UserTrips::find($id);
      $userTrip->title = session()->get('trip-title');
      $userTrip->description = session()->get('trip-description');
      if($userTrip->save()){
        return redirect()->route('user.my-trip-details',$id);
      }
    }
    else{
      return redirect()->route('user.my-trip-details',$id);
    }
  }


}
