<?php

namespace App\Http\Controllers\Admin\Country;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Country\StoreCountryBasic;
use App\Http\Requests\Admin\Country\StoreEssentials;
use App\Http\Requests\Admin\Country\StoreVideos;
use App\Http\Requests\Admin\Country\UpdateCountryBasic;
use App\Models\Country;
use App\Models\UserArticle;
use App\Repositories\Admin\Country\CountryRepository;


class CountryController extends Controller
{

  protected $countryRepository;
  /**
   * CountryController constructor.
   *
   * @param CountryRepository $countryRepository
   */
  public function __construct(CountryRepository $countryRepository)
  {
    $this->countryRepository = $countryRepository;
  }


  public function index()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['name' => "Countries"]
    ];

    $countries =  Country::all();
    return view('pages.admin.country.index', [
      'countries' => $countries,
      'breadcrumbs' => $breadcrumbs
    ]);
  }


  public function create()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/countries/", 'name' => "Countries"], ['name' => "Create Country"]
    ];

    return view('pages.admin.country.create', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => Country::getStatusArr(),
      'priorityArr' => Country::getPriorityStatusArr()
    ]);
  }

  public function store(StoreCountryBasic $request)
  {
    $country = $this->countryRepository->create($request->all());
    return redirect()->route('admin.country.edit', $country->id)
      ->with('success', 'Country created successfully!');
  }

  public function edit(Country $country)
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/countries/", 'name' => "Countries"], ['name' => "Update Country"]
    ];

    return view('pages.admin.country.edit', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => UserArticle::getStatusArr(),
      'priorityArr' => Country::getPriorityStatusArr(),
      'country' => $country
    ]);
  }


  public function update(UpdateCountryBasic $request, Country $country)
  {
    $this->countryRepository->update($country, $request->all());

    return redirect()->route('admin.country.index')->with('success', 'Country updated successfully!');
  }


  public function destroy($id)
  {
    $deleteStatus = $this->countryRepository->deleteCountry($id);
    if($deleteStatus){
      return redirect()->back();
    }
    else{
      throw new Exception(__('Error while deleting country'));
    }
  }


  public function essentials(StoreEssentials $request, Country $country)
  {

    $countryEssentials = $this->countryRepository->storeEssentials($request->all(), $country->id);

    return redirect()->route('admin.country.edit', $countryEssentials->country_id)->with('success', __('Country Essential Updated'));
  }

  public function videos(StoreVideos $request, Country $country)
  {
    $countryEssentials = $this->countryRepository->storeVideos($request->all(), $country->id);

    return redirect()->route('admin.country.edit', $countryEssentials->country_id)->with('success', __('Country Videos Updated'));
  }

}
