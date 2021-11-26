<?php

namespace App\Http\Controllers\User\Trip;

use App\Http\Controllers\Controller;
use App\Models\CountryPlace;
use App\Models\UserTripExperience;
use App\Models\UserTripPlace;
use App\Models\UserTripProperty;
use App\Models\UserTrips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\Trip\UserTripRepository;
class UserTripsController extends Controller
{
  protected $userTripRepository;
  public function __construct(UserTripRepository $userTripRepository){
      $this->userTripRepository = $userTripRepository;
  }
  public function myTrips()
  {
    session()->forget(['places', 'properties','experiences','trip-title','trip-description','place_transport','place_nights']);
    $usertrips = UserTrips::with(['tripCountry'=>function($q){
    }])->has('tripCountry')->where('user_id',Auth::user()->id)->get();
    return view('pages.user.my-trips.index', [
      'usertrips' => $usertrips
    ]);
  }

  public function tripdetails($trip_id)
  {
    $usertrip = UserTrips::with([
      'tripExperiences'=>function($q){
      $q->with(['experienceFiles']);
    },'tripUser',
      'tripPlaces'=>function($q){
        $q->with(['placeFiles']);
      },
      'tripProperties'=>function($q){
        $q->with(['propertyFiles']);
      },
      'tripCountry' =>function($q){
//
      $q->with(['countryFile'=>function($qq){
        $qq->first();
      }]);
    }
    ])->find($trip_id);
    $date_diff = strtotime($usertrip->end_date) - strtotime($usertrip->start_date);
    $no_of_days = ( $date_diff/ (60 * 60 * 24));
    $places_count =   $usertrip->tripPlaces->count();
    $first_place = $usertrip->tripPlaces->first();
    $last_place = $usertrip->tripPlaces->last();

    return view('pages.user.my-trips.trip-details', [
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
  }

  public function tripDelete($trip_id)
  {
    $usertrip = UserTrips::where('id',$trip_id)->delete();

    $usertripPlaces = UserTripPlace::where('user_trip_id',$trip_id)->delete();

    $usertripExperiences = UserTripExperience::where('user_trip_id',$trip_id)->delete();

    $usertripProperties = UserTripProperty::where('user_trip_id',$trip_id)->delete();

    return redirect()->back();
  }
  public function tripEdit(int $id){
      $userTrip = $this->userTripRepository->getById($id);
      return view('pages.user.my-trips.trip-intro-edit',
        [
          'usertrip'=>$userTrip,
          'start_date' => date('d M, Y', strtotime($userTrip->start_date)) ,
          'end_date' => date('d M, Y', strtotime($userTrip->end_date)),
          'placesdata'=>$userTrip->tripPlaces,
          'data' => [
            'layout' => 'trip',
            'page_edit'=>true,
            'footer' => false
          ]
        ]
      );
  }
  public function tripPlaceEdit(int $trip_id,int $place_id){
    session()->forget(['places', 'properties','experiences','trip-title','trip-description','place_transport','place_nights']);
    $userTrip = $this->userTripRepository->getById($trip_id,$place_id);
    $location = CountryPlace::select('latitude', 'longitude', 'id')->where('id',$place_id)->get()->map(function ($place) {
      return [
        $place->latitude,
        $place->longitude,
        2,
        $place->id,
        'place'
      ];
    });
    return view('pages.user.my-trips.trip-place-edit',
      [
        'usertrip'=>$userTrip,
        'start_date' => date('d M, Y', strtotime($userTrip->start_date)) ,
        'end_date' => date('d M, Y', strtotime($userTrip->end_date)),
        'location'=>$location,
        'data' => [
          'layout' => 'trip',
          'page_edit'=>true,
          'footer' => false
        ]
      ]
    );
  }
  public function tripPlaceUpdate(Request $request){
    $ids =$request->input('ids');
    $ids = explode(',',$ids);
    $trip_id = $ids[0];
    $place_id = $ids[1];
    if(session()->has('places') && session()->has('place_nights') && session()->has('startDate') && session()->has('endDate') && isset(Auth::user()->id))
    {
      $userTrip = UserTrips::find($trip_id);
      $tripPlaces = UserTripPlace::where('user_trip_id',$trip_id)->where('place_id',$place_id)->first();
      $startDate        =       session()->get('startDate');
      $endDate          =       session()->get('endDate');

      $startDate = date('Y-m-d', strtotime($startDate));
      $endDate = date('Y-m-d', strtotime($endDate));

      $userTrip->slug = isset($trip_title)? implode('-', explode(' ',$trip_title)) :' ';
      $userTrip->user_id = Auth::user()->id;
      $userTrip->starting_country_id = 0;
      $userTrip->start_date = $startDate;
      $userTrip->end_date = $endDate;
      $userTrip->price = ($userTrip->price)-($tripPlaces->transport_price);
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

            $userTripExperience = UserTripExperience::where('user_trip_id',$trip_id)->where('experience_id',$place_id)->first();
            if($userTripExperience->isEmpty()){
              $userTripExperience = new $userTripExperience();
              $userTripExperience->title = $experience['data']->title;
              $userTripExperience->description = $experience['data']->short_description;

              $userTripExperience->user_trip_id = $userTrip->id;
              $userTripExperience->experience_id = $experience['data']->id;
              $userTripExperience->experience_price = $experience['data']->price;
              $userTripExperience->place_id = $experience['data']->place_id;
            }
            else{
              $userTripExperience->title = $experience['data']->title;
              $userTripExperience->description = $experience['data']->short_description;

              $userTripExperience->user_trip_id = $userTrip->id;
              $userTripExperience->experience_id = $experience['data']->id;
              $userTripExperience->experience_price = $experience['data']->price;
              $userTripExperience->place_id = $experience['data']->place_id;
            }
            $userTripExperience->save();

            $total_trip_price = $total_trip_price+$experience['data']->price;
          }

        }
      }
      else{
        $userTripExperience = UserTripExperience::where('user_trip_id',$trip_id)->where('experience_id',$place_id)->delete();
      }

      if(session()->has('properties')){
        $properties = session()->get('properties');
        foreach($properties as $key=>$property){

          if(isset($property['data'])){

            $userTripProperty = UserTripProperty::where('user_trip_id',$trip_id)->where('property_id',$place_id)->first();
            if($userTripProperty->isEmpty()){
              $userTripProperty = new UserTripProperty();
              $userTripProperty->title = $property['data']->title;
              $userTripProperty->description = $property['data']->short_description;

              $userTripProperty->user_trip_id = $userTrip->id;
              $userTripProperty->property_id = $property['data']->id;
              $userTripProperty->place_id = $property['data']->place_id;
              $userTripProperty->property_price = $property['data']->price;
            }
            else{
              $userTripProperty->title = $property['data']->title;
              $userTripProperty->description = $property['data']->short_description;

              $userTripProperty->user_trip_id = $userTrip->id;
              $userTripProperty->property_id = $property['data']->id;
              $userTripProperty->place_id = $property['data']->place_id;
              $userTripProperty->property_price = $property['data']->price;
            }
            $userTripProperty->save();

            $total_trip_price = $total_trip_price+$property['data']->price;
          }

        }
      }
      else{
        $userTripProperty = UserTripProperty::where('user_trip_id',$trip_id)->where('property_id',$place_id)->delete();
      }


      $userTrip->price = ($userTrip->price)+$total_trip_price;
      $userTrip->starting_country_id = $country_id;
      $userTrip->save();
      session()->forget(['places', 'properties','experiences','trip-title','trip-description','place_transport','place_nights']);
      return response()->json(['status'=>true]);
    }
    else{
      return response()->json(['status'=>false]);
    }
  }

}
