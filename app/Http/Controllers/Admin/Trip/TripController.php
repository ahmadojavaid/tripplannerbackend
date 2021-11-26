<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Trip\ManageTrip;
use App\Http\Requests\Admin\Trip\StoreTrip;
use App\Http\Requests\Admin\Trip\UpdateTrip;
use App\Models\Country;
use App\Models\CountryPlace;
use App\Models\Experience;
use App\Models\Property;
use App\Models\Trip;
use App\Models\TripExperience;
use App\Models\TripPlace;
use App\Models\TripPlacesN;
use App\Models\TripProperty;
use App\Repositories\Admin\Trip\TripRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TripController extends Controller
{
  /**
   * TripController constructor.
   *
   * @param TripRepository $tripRepository
   */
  public function __construct(TripRepository $tripRepository)
  {
    $this->tripRepository = $tripRepository;
  }


  public function index(ManageTrip $request)
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['name' => "Trips"]
    ];

    $trips =  Trip::all();
    return view('pages.admin.trip.index', [
      'breadcrumbs' => $breadcrumbs,
      'trips' => $trips,
    ]);
  }
  public function create()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/trips", 'name' => "Trip Manager"], ['name' => "Create Trip"]
    ];
    return view('pages.admin.trip.create', [
      'breadcrumbs' => $breadcrumbs,
      'countriesArr' => Country::where('status', Country::STATUS_ACTIVE)->pluck('name', 'id'),
      'placesArr' => CountryPlace::pluck('name', 'id'),
      'categoryArr' => Trip::getCategoryArr(),
      'statusArr' => Trip::getStatusArr(),
      'priorityArr' => Trip::getPriorityStatusArr(),
    ]);
  }

//  public function store(StoreTrip $request)
  public function store(Request $request)
  {
//    return $request->places_count;
//    return $request->all();

    $startDate = date('Y-m-d', strtotime($request->start_date));
    $endDate = date('Y-m-d', strtotime($request->end_date));

    $userTrip = new Trip();
    $userTrip->title = Str::slug($request->title);
    $userTrip->description = $request->description;
    $userTrip->start_date = $startDate;
    $userTrip->end_date = $endDate;
    $userTrip->slug = Str::slug($request->title);

    $userTrip->country_id = $request->country;
    $userTrip->status = $request->status;
    $userTrip->priority_status = $request->priority;
    $userTrip->category = $request->category;

    $userTrip->price = $request->price;
    $userTrip->created_by = Auth::guard('admin')->user()->id;
    $userTrip->photo = 0;
    $userTrip->route_map_photo = 0;
    $userTrip->save();
    $userTrip->storeBase64File($request->photo);
    $userTrip->storeBase64Filex($request->route_map_photo);

//    return $userTrip;

    $places_count = $request->places_count;
    for($i = 0;$i<=$places_count;$i++)
    {
      $places = 'places'.$i;
      $no_of_nights = 'no_of_nights'.$i;
      $transport = 'transport'.$i;

//      ----------------------------------------------------------------
      $nights = 2;
      if($request->has($no_of_nights))
      {
        $nights = $request[$no_of_nights];
      }
      $transport_route_name = '';

      if($request->has($transport))
      {
        $transport_route_name = $request[$transport];
      }

      $placex = CountryPlace::find($request[$places]);

      $tripPlaces = new TripPlacesN();
      $tripPlaces->place_id = $request[$places];
      $tripPlaces->title = $placex->name;
      $tripPlaces->description = $placex->short_description;
      $tripPlaces->no_of_nights = $nights;
      $tripPlaces->trip_id = $userTrip->id ;
      $tripPlaces->transport_title = $transport_route_name;
      $tripPlaces->save();

      $experiences = 'experiences'.$i;
      $properties = 'properties'.$i;
      if($request->has($experiences))
      {
        $experiencess = $request[$experiences];

        for($j = 0;$j<count($experiencess) ;$j++){

          $exp = Experience::find($experiencess[$j]);
          if(isset($exp)){
            $userTripExperience = new TripExperience();
            $userTripExperience->title = $exp->title;
            $userTripExperience->description = $exp->short_description;
            $userTripExperience->trip_id = $userTrip->id;
            $userTripExperience->experience_id = $exp->id;
            $userTripExperience->experience_price = $exp->price;
            $userTripExperience->place_id = $exp->place_id;
            $userTripExperience->save();
          }
        }
      }
      if($request->has($properties))
      {
        $propertiess = $request[$properties];

        for($k = 0;$k<count($propertiess) ;$k++){

          $prop = Property::find($propertiess[$k]);
          if(isset($prop)){
            $userTripProperty = new TripProperty();
            $userTripProperty->title = $prop->title;
            $userTripProperty->description = $prop->short_description;
            $userTripProperty->trip_id = $userTrip->id;
            $userTripProperty->property_id = $prop->id;
            $userTripProperty->property_price = $prop->price;
            $userTripProperty->place_id = $prop->place_id;
            $userTripProperty->save();
          }

        }

      }

//      ------------------------------------
    }
    return redirect()->route('admin.trip.index')->with('success', __('Trip Created'));
  }


  public function edit($id)
  {

    $trip = Trip::with('countryPlaces.place')->where('id', $id)->firstOrFail();
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/trips", 'name' => "Trip Manager"], ['name' => "Update Trip"]
    ];

    return view('pages.admin.trip.edit', [
      'breadcrumbs' => $breadcrumbs,
      'trip' => $trip,
      'countriesArr' => Country::where('status', Country::STATUS_ACTIVE)->pluck('name', 'id'),
      'placesArr' => CountryPlace::pluck('name', 'id'),
      'categoryArr' => Trip::getCategoryArr(),
      'statusArr' => Trip::getStatusArr(),
      'priorityArr' => Trip::getPriorityStatusArr(),
    ]);
  }


  public function update(UpdateTrip $request, Trip $trip)
  {
    $this->tripRepository->update($trip, $request->only(
      'title',
      'description',
      'status',
      'priority',
      'category',
      "country",
      'slug',
      'price',
      'photo',
      'route_map_photo',
      'places',
      'startingPlace',
      'endingPlace'
    ));

    return redirect()->route('admin.trip.index')->with('success', __('Trip Updated'));
  }

  public function countryPlaces()
  {
    $places = CountryPlace::select('name as text', 'id')->where([
      ['country_id', "=", request()->country],
      ['name', 'like', '%' . request()->search . '%']
    ])->get()->toArray();
    return response()->json(['results' => $places]);
  }
  public function getCities(Request $request){
    $country_id = $request->id;

    $cities = CountryPlace::where('country_id',$country_id)->get();

    if(count($cities)!=0 ){
      $response['status']='success';
      $response['data']=$cities;
    } else {
      $response['status']='success';
      $response['data']='false';
    }
    return  json_encode($response);
  }

  public function getExperiencesProperties(Request $request){
    $place_id = $request->id;

    $experiences= Experience::where('place_id',$place_id)->get();
    $properties = Property::where('place_id',$place_id)->get();

    if(count($experiences)!=0 ||  count($properties)!=0){
      $response['status']='success';
      $response['data']='true';
      $response['data_experiences']=$experiences;
      $response['data_properties']=$properties;
    } else {
      $response['status']='success';
      $response['data']='false';
    }
    return  json_encode($response);
  }



  public function destroy($id)
  {
    $deleteStatus = $this->tripRepository->deleteTrip($id);
    if($deleteStatus){
      return redirect()->back();
    }
    else{
      throw new Exception(__('Error while deleting country'));
    }
  }
}
