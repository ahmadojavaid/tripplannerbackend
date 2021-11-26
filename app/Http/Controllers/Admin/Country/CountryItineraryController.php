<?php

namespace App\Http\Controllers\Admin\Country;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Country\StoreItinerary;
use App\Http\Requests\Admin\Country\UpdateItinerary;
use App\Models\Country;
use App\Models\CountryItinerary;
use App\Repositories\Admin\Country\CountryItinerayRepository;



class CountryItineraryController extends Controller
{

  protected $itineraryRepository;
  /**
   * CountryItineraryController constructor.
   *
   * @param CountryItinerayRepository $itineraryRepository
   */
  public function __construct(CountryItinerayRepository $itineraryRepository)
  {
    $this->itineraryRepository = $itineraryRepository;
  }


  public function index()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['name' => "Country Itineraries"]
    ];

    $itineraries =  CountryItinerary::with('itineraryCountry', 'itineraryUser')->get();
    return view('pages.admin.country-itinerary.index', [
      'itineraries' => $itineraries,
      'breadcrumbs' => $breadcrumbs
    ]);
  }


  public function create()
  {

    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/countries/itineraries", 'name' => "Country Itineraries"], ['name' => "Create Itinerary"]
    ];

    return view('pages.admin.country-itinerary.create', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => CountryItinerary::getStatusArr(),
      'priorityStatusArr' => CountryItinerary::getPriorityStatusArr(),
      'countryArr' => Country::getCountryArr()
    ]);
  }

  public function store(StoreItinerary $request)
  {
    $this->itineraryRepository->create($request->all());
    return redirect()->route('admin.country.itinerary.index')->with('success', __('Country Itinerary created'));
  }

  public function edit(CountryItinerary $itinerary)
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/countries/itineraries", 'name' => "Country Itineraries"], ['name' => "Update Itinerary"]
    ];

    return view('pages.admin.country-itinerary.edit', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => CountryItinerary::getStatusArr(),
      'priorityStatusArr' => CountryItinerary::getPriorityStatusArr(),
      'countryArr' => Country::getCountryArr(),
      'itinerary' => $itinerary
    ]);
  }


  public function update(UpdateItinerary $request, CountryItinerary $itinerary)
  {
    $this->itineraryRepository->update($itinerary, $request->all());
    return redirect()->route('admin.country.itinerary.index')->with('success', __('Country Itinerary updated'));
  }


  public function destroy(int $id)
  {
    $deleteStatus = $this->itineraryRepository->deleteItenarary($id);
    if($deleteStatus){
      return redirect()->back();
    }
    else{
      throw new Exception(__('Error while deleting country'));
    }
  }
}
