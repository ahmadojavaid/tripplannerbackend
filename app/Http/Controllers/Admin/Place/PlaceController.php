<?php

namespace App\Http\Controllers\Admin\Place;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Place\StoreEssentials;
use App\Http\Requests\Admin\Place\StorePlace;
use App\Http\Requests\Admin\Place\StoreVideos;
use App\Http\Requests\Admin\Place\UpdatePlace;
use App\Models\Country;
use App\Models\CountryPlace;
use App\Models\PlaceResidual;
use App\Repositories\Admin\Place\PlaceRepository;



class PlaceController extends Controller
{

  protected $placeRepository;
  /**
   * CountryPlaceController constructor.
   *
   * @param PlaceRepository $placeRepository
   */
  public function __construct(PlaceRepository $placeRepository)
  {
    $this->placeRepository = $placeRepository;
  }


  public function index()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['name' => "Country Places"]
    ];

    $places =  CountryPlace::with('placeCountry')->get();
    return view('pages.admin.place.index', [
      'places' => $places,
      'breadcrumbs' => $breadcrumbs
    ]);
  }


  public function create()
  {

    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/countries/places", 'name' => "Country Places"], ['name' => "Create Place"]
    ];

    return view('pages.admin.place.create', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => CountryPlace::getStatusArr(),
      'priorityArr' => CountryPlace::getPriorityStatusArr(),
      'countryArr' => Country::getCountryArr(),
      'typeArr' => CountryPlace::getTypeArr()
    ]);
  }

  public function store(StorePlace $request)
  {
    $this->placeRepository->create($request->all());
    return redirect()->route('admin.country.place.index')->with('success', __('Country Place created'));
  }

  public function edit(CountryPlace $place)
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/countries/places", 'name' => "Country Places"], ['name' => "Update Place"]
    ];

    return view('pages.admin.place.edit', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => CountryPlace::getStatusArr(),
      'priorityArr' => CountryPlace::getPriorityStatusArr(),
      'countryArr' => Country::getCountryArr(),
      'typeArr' => CountryPlace::getTypeArr(),
      'place' => $place,
      'essentailFields' => PlaceResidual::getFields(),
      'essentailFieldData' => PlaceResidual::getFieldsArr($place->id),
      'videoFieldData' => PlaceResidual::getVideoFieldsArr($place->id)
    ]);
  }


  public function update(UpdatePlace $request, CountryPlace $place)
  {
    $this->placeRepository->update($place, $request->all());
    return redirect()->route('admin.country.place.index')->with('success', __('Country Place updated'));
  }


  public function destroy($id)
  {
    $deleteStatus = $this->placeRepository->deleteCountry($id);
    if($deleteStatus){
      return redirect()->back();
    }
    else{
      throw new Exception(__('Error while deleting Place'));
    }
  }


  public function essentials(StoreEssentials $request, CountryPlace $place)
  {
    $this->placeRepository->essentials($request->only(
      'why-to-go-there',
      'how-to-get-there',
      'how-to-fully-enjoy-it'
    ), $place->id);

    return redirect()->route('admin.country.place.edit', $place->id)->with('success', __('Place Essential Updated'));
  }

  public function videos(StoreVideos $request, CountryPlace $place)
  {

    $this->placeRepository->videos($request->all(), $place->id);

    return redirect()->route('admin.country.place.edit', $place->id)->with('success', __('Place Video Updated'));
  }
}
