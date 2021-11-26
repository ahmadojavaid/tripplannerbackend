<?php

namespace App\Http\Controllers\Admin\Property;

use App\Helpers\General\AmadeusHelper;
use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;


use App\Http\Requests\Admin\Property\StoreExternalProperty;
use App\Models\PropertyCategory;
use App\Models\PropertyType;
use App\Repositories\Admin\Place\PlaceRepository;
use App\Repositories\Admin\Property\ExternalPropertyRepository;

class ExternalPropertyController extends Controller
{

  protected $propertyRepository, $placeRepository;
  /**
   * ExternalProperty constructor.
   *
   * @param ExternalPropertyRepository $propertyRepository
   */
  public function __construct(ExternalPropertyRepository $propertyRepository, PlaceRepository $placeRepository)
  {
    $this->propertyRepository = $propertyRepository;
    $this->placeRepository = $placeRepository;
  }


  public function create()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/properties", 'name' => "Properties"], ['name' => "Create Property"]
    ];
    return view('pages.admin.property.external.create', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => Property::getStatusArr(),
      'priorityArr' => Property::getPriorityStatusArr(),
      'cityArr' => $this->placeRepository->placeArr(),
      'categoryArr' => PropertyCategory::getCategoryArr(),
      'typeArr' => PropertyType::getTypeArr()
    ]);
  }

  public function store(StoreExternalProperty $request)
  {
    $this->propertyRepository->create($request->all());
    return redirect()->route('admin.property.index')->with('success', __('Place Property created'));
  }



  public function list(Request $request)
  {
    $response = ['results' => []];
    if (!$request->city)
      return $response;

    $shortCode =  $this->placeRepository->getPlaceShortCode($request->city);

    //need to improve this working
    $data = (new AmadeusHelper)->getHotelList($shortCode);
    if (isset($data['errors']) || empty($data))
      return $response;

    $items = collect($data['data'])->map(function ($hotel) {
      return ['text' => $hotel['hotel']['name'],  'id' => $hotel['hotel']['hotelId']];
    });

    return ['results' => array_values($items->toArray())];
  }
}
